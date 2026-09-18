/**
 * Regla de negocio del contador de vistas: una vista por navegador cada 24 horas
 * por articulo. Se prueba el modulo real que usan la web publica y el panel
 * (`resources/js/utils/blogViewCounter.js`) con localStorage y fetch falsos, sin
 * navegador ni dependencias nuevas.
 *
 * Ejecutar: node --test tests/js/blogViewCounter.test.mjs
 */

import test from 'node:test';
import assert from 'node:assert/strict';

import {
    VIEW_STORAGE_KEY,
    VIEW_TTL_MS,
    forgetView,
    hasRecentView,
    markView,
    readViewRegistry,
    registerBlogArticleView,
    resolveViewUrl,
    viewFallbackUrl,
} from '../../resources/js/utils/blogViewCounter.js';

const SLUG = 'impuesto-a-la-renta';
const ENDPOINT = '/blog/' + SLUG + '/vista';
const T0 = 1_800_000_000_000;

function fakeStorage() {
    const data = new Map();

    return {
        getItem: (key) => (data.has(key) ? data.get(key) : null),
        setItem: (key, value) => data.set(key, String(value)),
        removeItem: (key) => data.delete(key),
        raw: data,
    };
}

function jsonResponse(body, { ok = true, status = 200 } = {}) {
    return { ok, status, json: async () => body };
}

function recordingFetcher(response) {
    const calls = [];

    const fetcher = async (url, options) => {
        calls.push({ url, options });

        return response;
    };

    fetcher.calls = calls;

    return fetcher;
}

test('la primera visita cuenta, guarda la marca y devuelve el numero del servidor', async () => {
    const storage = fakeStorage();
    const fetcher = recordingFetcher(jsonResponse({ success: true, views: 42 }));
    const counted = [];

    const result = await registerBlogArticleView({
        slug: SLUG,
        url: ENDPOINT,
        storage,
        now: T0,
        fetcher,
        onCounted: (views) => counted.push(views),
    });

    assert.equal(result, true);
    assert.deepEqual(counted, [42]);
    assert.equal(fetcher.calls.length, 1);
    assert.equal(fetcher.calls[0].url, ENDPOINT);
    assert.equal(fetcher.calls[0].options.method, 'POST');
    assert.equal(fetcher.calls[0].options.credentials, 'same-origin');
    assert.equal(hasRecentView(SLUG, { storage, now: T0 }), true);
    assert.deepEqual(JSON.parse(storage.raw.get(VIEW_STORAGE_KEY)), { [SLUG]: T0 });
});

test('la segunda visita dentro de las 24 horas no vuelve a llamar al endpoint', async () => {
    const storage = fakeStorage();
    const fetcher = recordingFetcher(jsonResponse({ success: true, views: 2 }));

    await registerBlogArticleView({ slug: SLUG, storage, now: T0, fetcher });

    const second = await registerBlogArticleView({
        slug: SLUG,
        storage,
        now: T0 + VIEW_TTL_MS - 60_000,
        fetcher,
    });

    assert.equal(second, false);
    assert.equal(fetcher.calls.length, 1);
});

test('la marca caduca a las 24 horas exactas', async () => {
    const storage = fakeStorage();
    const fetcher = recordingFetcher(jsonResponse({ success: true, views: 3 }));

    markView(SLUG, { storage, now: T0 });

    assert.equal(hasRecentView(SLUG, { storage, now: T0 + 23 * 60 * 60 * 1000 }), true);
    assert.equal(hasRecentView(SLUG, { storage, now: T0 + 25 * 60 * 60 * 1000 }), false);

    const later = await registerBlogArticleView({
        slug: SLUG,
        storage,
        now: T0 + VIEW_TTL_MS + 1,
        fetcher,
    });

    assert.equal(later, true);
    assert.equal(fetcher.calls.length, 1);
});

test('un POST rechazado no deja marca y se puede reintentar despues', async () => {
    const storage = fakeStorage();
    const failing = recordingFetcher(jsonResponse({ success: false, message: 'Articulo no encontrado.' }, { ok: false, status: 404 }));

    const first = await registerBlogArticleView({ slug: SLUG, storage, now: T0, fetcher: failing });

    assert.equal(first, false);
    assert.equal(hasRecentView(SLUG, { storage, now: T0 }), false);

    const working = recordingFetcher(jsonResponse({ success: true, views: 9 }));
    const second = await registerBlogArticleView({ slug: SLUG, storage, now: T0 + 1000, fetcher: working });

    assert.equal(second, true);
    assert.equal(working.calls.length, 1);
});

test('una caida de red no propaga el error ni deja marca', async () => {
    const storage = fakeStorage();

    const result = await registerBlogArticleView({
        slug: SLUG,
        storage,
        now: T0,
        fetcher: async () => {
            throw new Error('network down');
        },
    });

    assert.equal(result, false);
    assert.equal(hasRecentView(SLUG, { storage, now: T0 }), false);
});

test('una respuesta 500 con HTML en lugar de JSON no rompe ni deja marca', async () => {
    const storage = fakeStorage();

    const result = await registerBlogArticleView({
        slug: SLUG,
        storage,
        now: T0,
        fetcher: async () => ({
            ok: false,
            status: 500,
            json: async () => {
                throw new Error('no es JSON');
            },
        }),
    });

    assert.equal(result, false);
    assert.equal(hasRecentView(SLUG, { storage, now: T0 }), false);
});

test('sin localStorage no se cuenta nada (mejor no contar que inflar el contador)', async () => {
    const fetcher = recordingFetcher(jsonResponse({ success: true, views: 1 }));

    const result = await registerBlogArticleView({ slug: SLUG, storage: null, now: T0, fetcher });

    assert.equal(result, false);
    assert.equal(fetcher.calls.length, 0);
    assert.deepEqual(readViewRegistry(null), {});
});

test('sin slug no se llama al endpoint', async () => {
    const storage = fakeStorage();
    const fetcher = recordingFetcher(jsonResponse({ success: true, views: 1 }));

    const result = await registerBlogArticleView({ slug: '', storage, now: T0, fetcher });

    assert.equal(result, false);
    assert.equal(fetcher.calls.length, 0);
});

test('envia el token CSRF del meta tag', async () => {
    const storage = fakeStorage();
    const fetcher = recordingFetcher(jsonResponse({ success: true, views: 5 }));

    globalThis.document = {
        querySelector: (selector) =>
            selector === 'meta[name="csrf-token"]' ? { getAttribute: () => 'token-abc' } : null,
    };

    try {
        await registerBlogArticleView({ slug: SLUG, storage, now: T0, fetcher });
    } finally {
        delete globalThis.document;
    }

    assert.equal(fetcher.calls[0].options.headers['X-CSRF-TOKEN'], 'token-abc');
    assert.equal(fetcher.calls[0].options.headers['X-Requested-With'], 'XMLHttpRequest');
});

test('sin Ziggy la url cae al prefijo del blog con el slug escapado', () => {
    assert.equal(resolveViewUrl('mi articulo/1'), '/blog/mi%20articulo%2F1/vista');
    assert.equal(resolveViewUrl(SLUG), viewFallbackUrl(SLUG));
});

test('con Ziggy disponible usa el nombre de ruta blog_article_view', () => {
    globalThis.window = { route: (name, slug) => `/${name}/${slug}` };

    try {
        assert.equal(resolveViewUrl(SLUG), `/blog_article_view/${SLUG}`);
    } finally {
        delete globalThis.window;
    }
});

test('si Ziggy no conoce la ruta se usa el respaldo en vez de romper', () => {
    globalThis.window = {
        route: () => {
            throw new Error('Ziggy error: route is not in the route list');
        },
    };

    try {
        assert.equal(resolveViewUrl(SLUG), '/blog/' + SLUG + '/vista');
    } finally {
        delete globalThis.window;
    }
});

test('al guardar se descartan las marcas vencidas para que el mapa no crezca', () => {
    const storage = fakeStorage();

    markView('viejo', { storage, now: T0 });
    markView('nuevo', { storage, now: T0 + VIEW_TTL_MS + 1 });

    assert.deepEqual(Object.keys(readViewRegistry(storage)), ['nuevo']);
});

test('forgetView quita solo el articulo indicado', () => {
    const storage = fakeStorage();

    markView('uno', { storage, now: T0 });
    markView('dos', { storage, now: T0 });

    forgetView('uno', { storage });

    assert.equal(hasRecentView('uno', { storage, now: T0 }), false);
    assert.equal(hasRecentView('dos', { storage, now: T0 }), true);
});

test('un registro corrupto en localStorage no impide contar', async () => {
    const storage = fakeStorage();
    storage.setItem(VIEW_STORAGE_KEY, 'no-json');

    const fetcher = recordingFetcher(jsonResponse({ success: true, views: 4 }));

    const result = await registerBlogArticleView({ slug: SLUG, storage, now: T0, fetcher });

    assert.equal(result, true);
    assert.deepEqual(JSON.parse(storage.raw.get(VIEW_STORAGE_KEY)), { [SLUG]: T0 });
});
