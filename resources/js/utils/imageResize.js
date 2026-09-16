/**
 * Redimensionado de imagenes en el navegador antes de subirlas al backend.
 *
 * El tope de ancho (440px) es el mismo que aplica el servidor en
 * App\Services\ImageResizer: aqui solo se adelanta el trabajo para que el
 * archivo viaje liviano y el backend tenga la ultima palabra si algo falla.
 */

export const IMAGE_MAX_WIDTH = 440;

const RESIZABLE_TYPES = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

const isResizable = (file) => file instanceof File
    && RESIZABLE_TYPES.includes((file.type || '').toLowerCase());

const loadBitmap = async (file) => {
    if (typeof createImageBitmap === 'function') {
        try {
            // `imageOrientation` respeta la rotacion EXIF de las fotos de celular.
            return await createImageBitmap(file, { imageOrientation: 'from-image' });
        } catch (error) {
            // Navegadores que no aceptan las opciones: se reintenta mas abajo.
        }
    }

    return new Promise((resolve, reject) => {
        const image = new Image();
        const url = URL.createObjectURL(file);

        image.onload = () => {
            URL.revokeObjectURL(url);
            resolve(image);
        };
        image.onerror = () => {
            URL.revokeObjectURL(url);
            reject(new Error('No se pudo leer la imagen'));
        };
        image.src = url;
    });
};

const toBlob = (canvas, type, quality) => new Promise((resolve, reject) => {
    canvas.toBlob(
        (blob) => (blob ? resolve(blob) : reject(new Error('No se pudo exportar la imagen'))),
        type,
        quality
    );
});

/**
 * Devuelve un File del mismo formato con el ancho reducido a `maxWidth` y el
 * alto proporcional.
 *
 * - Nunca agranda: si la imagen ya es mas angosta que `maxWidth`, la devuelve igual.
 * - Solo procesa jpeg/png/webp; svg, gif, pdf o video pasan intactos (rasterizarlos
 *   perderia el vector o la animacion).
 * - Ante cualquier error devuelve el archivo original: la subida nunca se rompe y
 *   el backend aplica igual el tope.
 */
export async function resizeImageFile(file, maxWidth = IMAGE_MAX_WIDTH) {
    if (!isResizable(file)) {
        return file;
    }

    try {
        const source = await loadBitmap(file);
        const width = source.naturalWidth || source.width;
        const height = source.naturalHeight || source.height;

        if (!width || !height || width <= maxWidth) {
            if (typeof source.close === 'function') source.close();
            return file;
        }

        const targetWidth = Math.round(maxWidth);
        const targetHeight = Math.max(1, Math.round(height * (maxWidth / width)));

        const canvas = document.createElement('canvas');
        canvas.width = targetWidth;
        canvas.height = targetHeight;

        const context = canvas.getContext('2d');
        context.drawImage(source, 0, 0, targetWidth, targetHeight);

        if (typeof source.close === 'function') source.close();

        const type = file.type === 'image/jpg' ? 'image/jpeg' : file.type;
        const blob = await toBlob(canvas, type, type === 'image/jpeg' ? 0.9 : undefined);

        return new File([blob], file.name, {
            type: blob.type || type,
            lastModified: file.lastModified,
        });
    } catch (error) {
        console.warn('No se pudo redimensionar la imagen, se subira completa:', error.message);
        return file;
    }
}

export default resizeImageFile;
