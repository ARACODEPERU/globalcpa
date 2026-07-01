/**
 * Module-level CSRF token store.
 * Set automatically from Inertia page props or manually via setCsrfToken().
 */

let _csrfToken = null;

/**
 * Store the CSRF token and set it as the default X-CSRF-TOKEN header on axios.
 * @param {string} token
 */
export function setCsrfToken(token) {
    _csrfToken = token;

    if (window.axios) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
    }
}

/**
 * Return the current CSRF token, if any.
 * Falls back to reading from the meta tag.
 * @returns {string|null}
 */
export function getCsrfToken() {
    if (_csrfToken) return _csrfToken;

    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.getAttribute('content') : null;
}

/**
 * Wrap a payload object with the CSRF _token field.
 * Useful for requests that require the token as a POST field.
 * @param {Record<string, any>} payload
 * @returns {Record<string, any>}
 */
export function withCsrfPayload(payload) {
    return {
        ...payload,
        _token: getCsrfToken(),
    };
}
