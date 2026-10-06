/**
 * Generador de la documentación del módulo IntegrationHub (Centro de Integraciones).
 *
 * Hace dos cosas:
 *   1. Inicia sesión en el sistema y captura las pantallas del módulo en docs/integration-hub/capturas/.
 *   2. Renderiza docs/integration-hub/manual.html a docs/integration-hub/IntegrationHub-Manual.pdf.
 *
 * IMPORTANTE: este script NO ejecuta integraciones (no pulsa "Ejecutar Ahora"), por lo que
 * nunca dispara peticiones a las APIs externas reales (n8n, ChatLevel, etc.).
 *
 * Requisitos: la aplicación debe estar levantada (Laragon) y su front en modo dev
 * (`npm run dev`, el proyecto usa el plugin de Vite de Laravel y public/hot).
 *
 * Uso:
 *   node scripts/generate-integrationhub-docs.mjs                  # capturas + PDF
 *   node scripts/generate-integrationhub-docs.mjs --solo-capturas  # sólo capturas
 *   node scripts/generate-integrationhub-docs.mjs --solo-pdf       # sólo PDF
 *   node scripts/generate-integrationhub-docs.mjs --solo-capturas --solo=03,17  # recapturar sólo algunas
 *
 * Variables de entorno opcionales:
 *   DOCS_BASE_URL (default http://globalcpa.test)
 *   DOCS_USER     (default sadmin@gmail.com)
 *   DOCS_PASS     (default 12345678)
 */

import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import puppeteer from 'puppeteer';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const ROOT = path.resolve(__dirname, '..');
const OUT_DIR = path.join(ROOT, 'docs', 'integration-hub');
const SHOTS_DIR = path.join(OUT_DIR, 'capturas');
const HTML_FILE = path.join(OUT_DIR, 'manual.html');
const PDF_FILE = path.join(OUT_DIR, 'IntegrationHub-Manual.pdf');

const BASE_URL = (process.env.DOCS_BASE_URL || 'http://globalcpa.test').replace(/\/$/, '');
const USER = process.env.DOCS_USER || 'sadmin@gmail.com';
const PASS = process.env.DOCS_PASS || '12345678';

const LISTADO = `${BASE_URL}/integrationhub/listado`;
const CREAR = `${BASE_URL}/integrationhub/create`;
const ERRORES = `${BASE_URL}/integrationhub/errores`;
const FLOW_IDS = `${BASE_URL}/integrationhub/flow-ids`;
/** Integración 1 = ChatLevel.ai: 8 endpoints, 20 mapeos, 1 autenticación y 2 programaciones. */
const EDIT_PRINCIPAL = `${BASE_URL}/integrationhub/editar/1`;
/** Integración 2 = N8N_Global: el webhook que usa el módulo Commercial. */
const EDIT_N8N = `${BASE_URL}/integrationhub/editar/2`;

const args = process.argv.slice(2);
const soloCapturas = args.includes('--solo-capturas');
const soloPdf = args.includes('--solo-pdf');
/** Filtro opcional: --solo=03,17 vuelve a capturar sólo esas (por su prefijo numérico). */
const filtro = (args.find((arg) => arg.startsWith('--solo=')) || '').replace('--solo=', '');
const prefijos = filtro ? filtro.split(',').map((valor) => valor.trim()).filter(Boolean) : [];

const sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

/** Espera a que la página esté realmente renderizada (Inertia + Vue montados). */
async function esperarTexto(page, texto, timeout = 60000) {
  await page.waitForFunction(
    (t) => document.body && document.body.innerText.includes(t),
    { timeout },
    texto,
  );
}

/**
 * Hace clic en el primer botón visible cuyo texto coincida con la etiqueta.
 * Se usa un clic real por DOM para que los handlers de Vue se disparen igual.
 */
async function clicTexto(page, etiqueta, tag = 'button') {
  const encontrado = await page.evaluate(
    (texto, etiquetaTag) => {
      const normalizar = (valor) => (valor || '').replace(/\s+/g, ' ').trim().toLowerCase();
      const objetivo = normalizar(texto);
      const candidatos = [...document.querySelectorAll(etiquetaTag)].filter((el) => {
        const estilo = window.getComputedStyle(el);
        const visible = estilo.display !== 'none' && estilo.visibility !== 'hidden' && el.offsetParent !== null;
        return visible && normalizar(el.textContent).includes(objetivo);
      });
      if (!candidatos.length) return false;
      // Preferir coincidencia exacta para no confundir "Ejecutar" con "Ejecutar Ahora".
      const exacto = candidatos.find((el) => normalizar(el.textContent) === objetivo);
      const elegido = exacto || candidatos[0];
      elegido.scrollIntoView({ block: 'center' });
      elegido.click();
      return true;
    },
    etiqueta,
    tag,
  );

  if (!encontrado) {
    throw new Error(`No se encontró un ${tag} visible con el texto "${etiqueta}"`);
  }

  await sleep(600);
}

/** Espera a que alguna tabla visible tenga filas (historial de logs, por ejemplo). */
async function esperarFilas(page, timeout = 60000) {
  await page.waitForFunction(
    () => [...document.querySelectorAll('tbody tr')].some((fila) => fila.offsetParent !== null),
    { timeout },
  );
  await sleep(600);
}

async function iniciarSesion(page) {
  await page.goto(`${BASE_URL}/login`, { waitUntil: 'domcontentloaded' });
  await page.waitForSelector('#Email', { timeout: 90000 });
  await page.type('#Email', USER, { delay: 15 });
  await page.type('#Password', PASS, { delay: 15 });
  // El formulario de login es Vue/Inertia: se envía con el botón, no con Enter.
  await page.evaluate(() => {
    const boton = document.querySelector('button[type="submit"]');
    if (boton) boton.click();
  });
  await page.waitForFunction(() => !window.location.pathname.startsWith('/login'), { timeout: 90000 });
  await sleep(3500);

  const url = page.url();
  if (url.includes('/login')) {
    const aviso = await page.evaluate(() => document.body.innerText.slice(0, 300));
    throw new Error(`No se pudo iniciar sesión. URL=${url}\n${aviso}`);
  }
  console.log(`✓ Sesión iniciada (${url})`);

  // El dashboard muestra un panel de "Personalizar interfaz" al entrar: se cierra
  // para que no aparezca superpuesto en ninguna captura.
  await page.keyboard.press('Escape');
  await sleep(500);
  await page.evaluate(() => {
    const cerrar = [...document.querySelectorAll('button')].find((el) =>
      /^(cerrar|close)$/i.test((el.textContent || '').trim()),
    );
    if (cerrar) cerrar.click();
  });
  await sleep(500);
}

/**
 * Capturas del manual. `preparar` navega y deja la pantalla lista; `clip` es opcional.
 */
const capturas = [
  { archivo: '01-listado.png', url: LISTADO, texto: 'Integraciones API', preparar: null },
  { archivo: '02-listado-busqueda.png', url: `${LISTADO}?search=N8N`, texto: 'Integraciones API' },
  { archivo: '03-crear-integracion.png', url: CREAR, texto: 'Nombre de la Integración' },
  {
    archivo: '04-crear-validacion.png',
    url: CREAR,
    texto: 'Nombre de la Integración',
    preparar: (page) => clicTexto(page, 'Guardar Integración'),
  },
  { archivo: '05-edit-general.png', url: EDIT_PRINCIPAL, texto: 'Datos Generales' },
  { archivo: '06-edit-autenticacion.png', url: EDIT_PRINCIPAL, texto: 'Datos Generales', preparar: (page) => clicTexto(page, 'Autenticación') },
  {
    archivo: '07-edit-autenticacion-modal.png',
    url: EDIT_PRINCIPAL,
    texto: 'Datos Generales',
    preparar: async (page) => {
      await clicTexto(page, 'Autenticación');
      await clicTexto(page, 'Agregar Campo');
    },
  },
  { archivo: '08-edit-endpoints.png', url: EDIT_PRINCIPAL, texto: 'Datos Generales', preparar: (page) => clicTexto(page, 'Endpoints') },
  {
    archivo: '09-edit-endpoints-modal.png',
    url: EDIT_PRINCIPAL,
    texto: 'Datos Generales',
    preparar: async (page) => {
      await clicTexto(page, 'Endpoints');
      await clicTexto(page, 'Agregar Endpoint');
    },
  },
  { archivo: '10-edit-mapeo-campos.png', url: EDIT_PRINCIPAL, texto: 'Datos Generales', preparar: (page) => clicTexto(page, 'Mapeo Campos') },
  {
    archivo: '11-edit-mapeo-modal.png',
    url: EDIT_PRINCIPAL,
    texto: 'Datos Generales',
    preparar: async (page) => {
      await clicTexto(page, 'Mapeo Campos');
      await clicTexto(page, 'Agregar Mapeo');
    },
  },
  { archivo: '12-edit-programacion.png', url: EDIT_PRINCIPAL, texto: 'Datos Generales', preparar: (page) => clicTexto(page, 'Programación') },
  {
    archivo: '13-edit-programacion-modal.png',
    url: EDIT_PRINCIPAL,
    texto: 'Datos Generales',
    preparar: async (page) => {
      await clicTexto(page, 'Programación');
      await clicTexto(page, 'Agregar Programación', 'button');
    },
  },
  { archivo: '14-edit-ejecutar.png', url: EDIT_PRINCIPAL, texto: 'Datos Generales', preparar: (page) => clicTexto(page, 'Ejecutar') },
  { archivo: '15-edit-integracion-codigo.png', url: EDIT_PRINCIPAL, texto: 'Datos Generales', preparar: (page) => clicTexto(page, 'Integración') },
  {
    archivo: '16-edit-historial.png',
    url: EDIT_PRINCIPAL,
    texto: 'Datos Generales',
    preparar: async (page) => {
      await clicTexto(page, 'Historial');
      await esperarFilas(page);
    },
  },
  {
    archivo: '17-edit-historial-detalle.png',
    url: EDIT_PRINCIPAL,
    texto: 'Datos Generales',
    preparar: async (page) => {
      await clicTexto(page, 'Historial');
      await esperarFilas(page);
      // Icono de detalle (último botón de la primera fila visible de la tabla de logs).
      // Todas las pestañas están en el DOM con v-show, así que hay que filtrar la visible.
      await page.evaluate(() => {
        const visible = (el) => el.offsetParent !== null && getComputedStyle(el).display !== 'none';
        const fila = [...document.querySelectorAll('tbody tr')].find(visible);
        const botones = fila ? [...fila.querySelectorAll('button')] : [];
        const boton = botones[botones.length - 1];
        if (boton) {
          boton.scrollIntoView({ block: 'center' });
          boton.click();
        }
      });
      await sleep(1500);
      // Desplegar el detalle real enviado/recibido dentro del modal.
      await clicTexto(page, 'Request Payload');
      await clicTexto(page, 'Response Body');
    },
  },
  {
    archivo: '18-edit-errores.png',
    url: EDIT_PRINCIPAL,
    texto: 'Datos Generales',
    preparar: async (page) => {
      await clicTexto(page, 'Errores');
      await esperarTexto(page, 'No hay errores registrados.');
    },
  },
  { archivo: '19-errores-global.png', url: ERRORES, texto: 'No hay errores registrados.' },
  { archivo: '20-flow-ids.png', url: FLOW_IDS, texto: 'Saludo de cumpleaños' },
  { archivo: '21-edit-general-n8n.png', url: EDIT_N8N, texto: 'Datos Generales' },
];

async function capturar(browser) {
  const page = await browser.newPage();
  await page.setViewport({ width: 1600, height: 1000, deviceScaleFactor: 2 });
  await page.emulateMediaFeatures([{ name: 'prefers-color-scheme', value: 'light' }]);
  // El proyecto corre en modo dev de Vite: la primera compilación de cada página es lenta.
  page.setDefaultTimeout(60000);
  page.setDefaultNavigationTimeout(120000);

  await iniciarSesion(page);

  const fallidas = [];
  const aCapturar = prefijos.length
    ? capturas.filter((captura) => prefijos.some((prefijo) => captura.archivo.startsWith(prefijo)))
    : capturas;

  for (const captura of aCapturar) {
    const destino = path.join(SHOTS_DIR, captura.archivo);
    try {
      await page.goto(captura.url, { waitUntil: 'domcontentloaded' });
      await esperarTexto(page, captura.texto);
      await sleep(700);
      if (captura.preparar) {
        await captura.preparar(page);
      }
      await page.screenshot({ path: destino, type: 'png' });
      const bytes = fs.statSync(destino).size;
      console.log(`✓ ${captura.archivo} (${(bytes / 1024).toFixed(0)} KB)`);
      if (bytes < 20000) {
        fallidas.push(`${captura.archivo}: archivo sospechosamente pequeño`);
      }
    } catch (error) {
      fallidas.push(`${captura.archivo}: ${error.message.split('\n')[0]}`);
      console.log(`✗ ${captura.archivo} -> ${error.message.split('\n')[0]}`);
    }
  }

  await page.close();

  if (fallidas.length) {
    console.log('\nCapturas con problemas:');
    fallidas.forEach((f) => console.log(`  - ${f}`));
  } else {
    console.log(`\n✓ ${aCapturar.length} capturas generadas en docs/integration-hub/capturas/`);
  }

  return fallidas;
}

async function generarPdf(browser) {
  if (!fs.existsSync(HTML_FILE)) {
    throw new Error(`No existe ${HTML_FILE}`);
  }

  const page = await browser.newPage();
  await page.goto(`file://${HTML_FILE.replace(/\\/g, '/')}`, { waitUntil: 'networkidle0' });
  await page.emulateMediaType('print');

  // Esperar a que todas las capturas referenciadas estén cargadas antes de imprimir.
  await page.evaluate(async () => {
    await Promise.all(
      [...document.images].map((img) =>
        img.complete ? Promise.resolve() : new Promise((resolve) => {
          img.addEventListener('load', resolve, { once: true });
          img.addEventListener('error', resolve, { once: true });
        }),
      ),
    );
  });

  const imagenesRota = await page.evaluate(() =>
    [...document.images].filter((img) => !img.naturalWidth).map((img) => img.getAttribute('src')),
  );
  if (imagenesRota.length) {
    throw new Error(`Capturas no encontradas en el HTML: ${imagenesRota.join(', ')}`);
  }
  console.log(`✓ ${(await page.evaluate(() => document.images.length))} capturas embebidas en el manual`);
  await sleep(500);

  await page.pdf({
    path: PDF_FILE,
    format: 'A4',
    landscape: true,
    printBackground: true,
    outline: true,
    margin: { top: '14mm', bottom: '16mm', left: '12mm', right: '12mm' },
    displayHeaderFooter: true,
    headerTemplate: `
      <div style="font-size:7px;color:#94a3b8;width:100%;padding:0 12mm;font-family:Segoe UI,Arial,sans-serif;">
        Centro de Integraciones (IntegrationHub) — Manual de uso
      </div>`,
    footerTemplate: `
      <div style="font-size:7px;color:#94a3b8;width:100%;padding:0 12mm;display:flex;justify-content:space-between;font-family:Segoe UI,Arial,sans-serif;">
        <span>Global CPA</span>
        <span>Página <span class="pageNumber"></span> de <span class="totalPages"></span></span>
      </div>`,
  });

  await page.close();
  const bytes = fs.statSync(PDF_FILE).size;
  console.log(`\n✓ PDF generado: docs/integration-hub/IntegrationHub-Manual.pdf (${(bytes / 1024).toFixed(0)} KB)`);
}

async function main() {
  fs.mkdirSync(SHOTS_DIR, { recursive: true });

  const browser = await puppeteer.launch({
    headless: true,
    args: ['--no-sandbox', '--disable-dev-shm-usage', '--font-render-hinting=none'],
  });

  try {
    if (!soloPdf) {
      const fallidas = await capturar(browser);
      if (fallidas.length) {
        process.exitCode = 1;
      }
    }
    if (!soloCapturas) {
      await generarPdf(browser);
    }
  } finally {
    await browser.close();
  }
}

main().catch((error) => {
  console.error(`\n✗ ${error.message}`);
  process.exit(1);
});
