# Documentación del Centro de Integraciones

Manual de uso y referencia técnica del módulo **Integrationhub** (módulo `M020`) de Global CPA.

## Entregable

| Archivo | Qué es |
|---|---|
| `IntegrationHub-Manual.pdf` | **El manual** (56 páginas, A4 horizontal, con las 21 capturas del sistema real). Es el documento que se comparte. |
| `manual.html` | Fuente del manual: contenido y estilos. Es lo que se edita cuando hay que cambiar el texto. |
| `capturas/` | Las 21 capturas PNG usadas en el manual, tomadas del sistema en ejecución. |

## Cómo regenerarlo

Requisitos: la aplicación levantada (Laragon) y el front en modo dev (`npm run dev`), porque el proyecto sirve los assets con el plugin de Vite de Laravel.

```bash
# Capturas nuevas + PDF
node scripts/generate-integrationhub-docs.mjs

# Sólo el PDF (cuando ya cambiaste textos en manual.html)
node scripts/generate-integrationhub-docs.mjs --solo-pdf

# Sólo las capturas
node scripts/generate-integrationhub-docs.mjs --solo-capturas

# Volver a capturar pantallas concretas (por el prefijo numérico del archivo)
node scripts/generate-integrationhub-docs.mjs --solo-capturas --solo=03,17
```

Si cambian las credenciales, se pueden pasar por variables de entorno:

```bash
DOCS_BASE_URL=http://globalcpa.test DOCS_USER=usuario@correo.com DOCS_PASS=clave node scripts/generate-integrationhub-docs.mjs
```

## Qué hace y qué no hace el generador

- Inicia sesión de verdad y recorre el módulo con un navegador headless, guardando cada pantalla en `capturas/`.
- **No ejecuta integraciones**: no pulsa «Ejecutar Ahora», así que no lanza peticiones a las APIs externas (n8n, ChatLevel.ai…). Las pantallas de resultados se documentan con el detalle de ejecuciones ya registradas en el Historial.
- Sólo escribe dentro de `docs/integration-hub/`.

## Índice del manual

1. Qué es el Centro de Integraciones
2. Arquitectura y piezas del módulo
3. Acceso, permisos y rutas
4. Listado de integraciones
5. Crear una integración
6. Editar una integración: las 9 pestañas (Datos Generales, Autenticación, Endpoints, Mapeo Campos, Programación, Ejecutar, Integración, Historial, Errores)
7. Páginas globales: Errores de Integración y Plantillas / Flujos
8. Ejecutar integraciones desde otros módulos
9. Operación y mantenimiento
10. Solución de problemas
11. Anexos: rutas, permisos, diccionario de tablas, checklist y caso real `N8N_Global`
