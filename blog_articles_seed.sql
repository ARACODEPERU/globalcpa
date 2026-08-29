-- =============================================
-- 20 Artículos de Blog (10 Contable + 10 NIIF)
-- Fechas al azar: Marzo 2026 - Agosto 2026
-- =============================================

INSERT INTO blog_articles (title, content_text, imagen, views, likes, url, publicity, status, keywords, short_description, category_id, user_id, created_at, updated_at) VALUES

-- ===================== CATEGORÍA 1: CONTABLE (IDs 5-14) =====================

('Principios de Contabilidad Generalmente Aceptados en el Perú',
CONCAT('<p>Los <strong>Principios de Contabilidad Generalmente Aceptados (PCGA)</strong> son el conjunto de normas, reglas y procedimientos que regulan la contabilidad en el Perú.</p><p>Estos principios garantizan que la información financiera sea confiable, comparable y relevante para la toma de decisiones.</p><p>Entre los principios más importantes se encuentran: la contabilidad de causación, la continuidad de la empresa, el costo histórico y la prudencia.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'principios-de-contabilidad-generalmente-aceptados-en-el-peru', NULL, 1, '["contabilidad","PCGA","principios","peru"]', 'Conoce los principios fundamentales que rigen la contabilidad en el Perú.', 1, 1, '2026-03-05 10:30:00', '2026-03-05 10:30:00'),

('Cómo Preparar los Estados Financieros de tu Empresa',
CONCAT('<p>Los <strong>estados financieros</strong> son documentos que reflejan la situación económica y financiera de una empresa.</p><p>Los principales estados financieros son: Estado de Situación Financiera (Balance General), Estado de Resultados, Estado de Flujo de Efectivo y Estado de Cambios en el Patrimonio Neto.</p><p>Cada uno de estos estados proporciona información diferente pero complementaria para evaluar la salud financiera del negocio.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'como-preparar-los-estados-financieros-de-tu-empresa', NULL, 1, '["estados financieros","balance general","empresa"]', 'Aprende a preparar correctamente los estados financieros de tu empresa.', 1, 1, '2026-03-18 14:15:00', '2026-03-18 14:15:00'),

('Diferencia entre Contabilidad Financiera y de Gestión',
CONCAT('<p>La <strong>contabilidad financiera</strong> se enfoca en reportar la información a terceros, mientras que la <strong>contabilidad de gestión</strong> proporciona información para la toma de decisiones internas.</p><p>Ambas son complementarias y esencial para el buen funcionamiento de cualquier organización.</p><p>En este artículo analizamos las principales diferencias entre ambas ramas de la contabilidad.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'diferencia-entre-contabilidad-financiera-y-de-gestion', NULL, 1, '["contabilidad financiera","contabilidad de gestión","diferencias"]', 'Conoce las diferencias fundamentales entre la contabilidad financiera y de gestión.', 1, 1, '2026-04-02 09:00:00', '2026-04-02 09:00:00'),

('Impuestos en el Perú: Guía para Contribuyentes',
CONCAT('<p>El sistema tributario peruano es administrado por la <strong>SUNAT</strong> y comprende diversos impuestos que todo contribuyente debe conocer.</p><p>Los principales impuestos incluyen: IGV (18%), Impuesto a la Renta, Impuesto Predial y Alcabala.</p><p>Es fundamental mantenerse actualizado sobre las obligaciones tributarias para evitar sanciones y multas.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'impuestos-en-el-peru-guia-para-contribuyentes', NULL, 1, '["impuestos","SUNAT","IGV","renta"]', 'Guía completa sobre los principales impuestos en el Perú.', 1, 1, '2026-04-15 11:45:00', '2026-04-15 11:45:00'),

('Análisis Financiero: Ratios más Importantes',
CONCAT('<p>El <strong>análisis financiero</strong> mediante ratios permite evaluar la liquidez, rentabilidad y solvencia de una empresa.</p><p>Los ratios más utilizados incluyen: Razón Corriente, Rotación de Inventarios, Margen Neto y ROE (Return on Equity).</p><p>Comprender estos indicadores es fundamental para tomar decisiones estratégicas de inversión y financiamiento.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'analisis-financiero-ratios-mas-importantes', NULL, 1, '["análisis financiero","ratios","inversión"]', 'Los ratios financieros más importantes para analizar tu empresa.', 1, 1, '2026-05-03 16:20:00', '2026-05-03 16:20:00'),

('Conciliación Bancaria: Paso a Paso para Hacerlo Correctamente',
CONCAT('<p>La <strong>conciliación bancaria</strong> es el proceso de comparar los registros contables de una empresa con los estados de cuenta del banco.</p><p>Este proceso permite identificar diferencias, movimientos no registrados y posibles errores o fraudes.</p><p>Realizar la conciliación bancaria de forma regular es una práctica esencial de control interno.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'conciliacion-bancaria-paso-a-paso-para-hacerlo-correctamente', NULL, 1, '["conciliación bancaria","banco","control interno"]', 'Aprende a realizar una conciliación bancaria de forma correcta y eficiente.', 1, 1, '2026-05-20 08:30:00', '2026-05-20 08:30:00'),

('Depreciación de Activos Fijos: Métodos y Cálculos',
CONCAT('<p>La <strong>depreciación</strong> es la pérdida de valor de los activos fijos por uso, desgaste o obsolescencia.</p><p>Los métodos más comunes son: Línea Recta, Unidades de Producción y Reducido (o de Saldo Decreciente).</p><p>Es importante elegir el método adecuado según la naturaleza del activo y la política contable de la empresa.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'depreciacion-de-activos-fijos-metodos-y-calculos', NULL, 1, '["depreciación","activos fijos","métodos"]', 'Conoce los métodos de depreciación y cómo calcularlos correctamente.', 1, 1, '2026-06-08 13:00:00', '2026-06-08 13:00:00'),

('Contabilidad de Costos: Clasificación y Métodos',
CONCAT('<p>La <strong>contabilidad de costos</strong> permite determinar el costo de producción de bienes y servicios.</p><p>Los costos se clasifican en: fijos, variables, directos e indirectos. Los métodos más utilizados son: por orden de producción y por proceso.</p><p>Una buena gestión de costos es clave para fijar precios competitivos y maximizar la rentabilidad.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'contabilidad-de-costos-clasificacion-y-metodos', NULL, 1, '["costos","producción","precios"]', 'Aprende a clasificar y calcular los costos de tu empresa.', 1, 1, '2026-07-01 10:15:00', '2026-07-01 10:15:00'),

('Cierre Contable Anual: Procedimiento y Verificaciones',
CONCAT('<p>El <strong>cierre contable</strong> es el proceso que se realiza al finalizar el ejercicio fiscal para determinar el resultado del período.</p><p>Este proceso incluye: balance de comprobación, asientos de ajuste, estados financieros y asientos de cierre.</p><p>Un cierre contable adecuado garantiza la confiabilidad de la información financiera para los usuarios.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'cierre-contable-anual-procedimiento-y-verificaciones', NULL, 1, '["cierre contable","anual","ejercicio fiscal"]', 'Guía completa del procedimiento de cierre contable anual.', 1, 1, '2026-08-10 15:45:00', '2026-08-10 15:45:00'),

-- ===================== CATEGORÍA 2: NIIF (IDs 15-24) =====================

('¿Qué son las NIIF y por qué son Importantes para tu Empresa?',
CONCAT('<p>Las <strong>Normas Internacionales de Información Financiera (NIIF)</strong> son un conjunto de estándares contables reconocidos a nivel mundial.</p><p>En el Perú, su implementación es obligatoria para las empresas que cotizan en bolsa y voluntaria para las demás.</p><p>Adoptar las NIIF mejora la transparencia y comparabilidad de la información financiera.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'que-son-las-niif-y-por-que-son-importantes-para-tu-empresa', NULL, 1, '["NIIF","normas","financiera","empresa"]', 'Conoce qué son las NIIF y cómo benefician a tu empresa.', 2, 1, '2026-03-12 09:00:00', '2026-03-12 09:00:00'),

('NIIF 16: Arrendamientos - Todo lo que Necesitas Saber',
CONCAT('<p>La <strong>NIIF 16</strong> establece las normas para el reconocimiento, medición, presentación y revelación de los contratos de arrendamiento.</p><p>Desde su implementación, los arrendatarios deben reconocer un activo por derecho de uso y una pasiva por arrendamiento en su balance.</p><p>Esta norma impacta significativamente en los indicadores financieros de las empresas.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'niif-16-arrendamientos-todo-lo-que-necesitas-saber', NULL, 1, '["NIIF 16","arrendamientos","balance"]', 'Análisis completo de la NIIF 16 sobre arrendamientos.', 2, 1, '2026-04-05 14:30:00', '2026-04-05 14:30:00'),

('NIIF para PyMEs: Características y Diferencias con las NIIF Plenas',
CONCAT('<p>Las <strong>NIIF para PyMEs</strong> son una versión simplificada de las normas internacionales, diseñadas para pequeñas y medianas empresas.</p><p>Simplifican aspectos como: combinaciones de negocios, arrendamientos, instrumentos financieros y revelaciones.</p><p>Son una excelente opción para empresas que buscanReportar bajo estándares internacionales con menor complejidad.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'niif-para-pymes-caracteristicas-y-diferencias-con-las-niif-plenas', NULL, 1, '["NIIF PyMEs","pequeñas empresas","simplificadas"]', 'Diferencias clave entre las NIIF para PyMEs y las NIIF plenas.', 2, 1, '2026-04-22 11:00:00', '2026-04-22 11:00:00'),

('NIIF 15: Ingresos de Actividades Ordinarias',
CONCAT('<p>La <strong>NIIF 15</strong> establece un modelo único para el reconocimiento de ingresos provenientes de contratos con clientes.</p><p>El modelo se basa en cinco pasos: identificar el contrato, las obligaciones, el precio de transacción, asignar el precio y reconocer el ingreso.</p><p>Esta norma reemplazó a la NIC 18 y la NIIF 11 para la mayoría de las industrias.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'niif-15-ingresos-de-actividades-ordinarias', NULL, 1, '["NIIF 15","ingresos","clientes"]', 'Explicación detallada de la NIIF 15 sobre reconocimiento de ingresos.', 2, 1, '2026-05-10 10:30:00', '2026-05-10 10:30:00'),

('Conversión de Estados Financieros al Marco de las NIIF',
CONCAT('<p>La <strong>conversión al marco NIIF</strong> es el proceso de adaptar los estados financieros preparados bajo PCGA locales a las normas internacionales.</p><p>Este proceso requiere análisis de diferencias, ajustes iniciales y revelaciones adicionales.</p><p>Es un proyecto estratégico que puede tomar varios meses dependiendo de la complejidad de la empresa.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'conversion-de-estados-financieros-al-marco-de-las-niif', NULL, 1, '["conversión","NIIF","PCGA","estados financieros"]', 'Guía paso a paso para convertir estados financieros al marco NIIF.', 2, 1, '2026-05-28 16:00:00', '2026-05-28 16:00:00'),

('Instrumentos Financieros bajo NIIF 9: Clasificación y Medición',
CONCAT('<p>La <strong>NIIF 9</strong> establece las normas para la clasificación y medición de instrumentos financieros, basándose en el modelo de negocio y las características del flujo de efectivo.</p><p>Los tres categorías son: a valor razonable con cambios en resultados, a costo amortizado y a valor razonable con cambios en el patrimonio.</p><p>La incorrección en la clasificación puede afectar significativamente los resultados financieros.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'instrumentos-financieros-bajo-niif-9-clasificacion-y-medicion', NULL, 1, '["NIIF 9","instrumentos financieros","clasificación"]', 'Clasificación y medición de instrumentos financieros según la NIIF 9.', 2, 1, '2026-06-15 09:45:00', '2026-06-15 09:45:00'),

('Provisión para Créditos Disminuidos bajo NIIF 9',
CONCAT('<p>La <strong>NIIF 9</strong> introduce el modelo de pérdidas esperadas esperadas para la medición de provisiones por incumplimiento crediticio.</p><p>A diferencia del modelo anterior (pérdidas incurridas), ahora se deben reconocer provisiones desde el momento de otorgamiento del crédito.</p><p>Esto requiere estimaciones y modelos estadísticos que representan un desafío para las entidades financieras.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'provision-para-creditos-disminuidos-bajo-niif-9', NULL, 1, '["NIIF 9","provisiones","créditos","pérdidas"]', 'Modelo de pérdidas esperadas para provisiones crediticias bajo NIIF 9.', 2, 1, '2026-07-05 14:15:00', '2026-07-05 14:15:00'),

('Cambios en las Políticas Contables bajo NIIF',
CONCAT('<p>Las <strong>cambios en políticas contables</strong> bajo NIIF deben aplicarse de forma retrospectiva, ajustando los períodos comparativos.</p><p>Los cambios solo están permitidos cuando la norma lo requiere o cuando resulta en información más confiable y relevante.</p><p>Es importante documentar adecuadamente los motivos del cambio y su impacto en los estados financieros.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'cambios-en-las-politicas-contables-bajo-niif', NULL, 1, '["políticas contables","cambios","retrospectivo"]', 'Reglas y procedimientos para cambios en políticas contables bajo NIIF.', 2, 1, '2026-07-20 11:30:00', '2026-07-20 11:30:00'),

('Aplicación de la NIC 16 - Propiedad, Planta y Equipo bajo NIIF',
CONCAT('<p>La <strong>NIC 16</strong> establece el tratamiento contable de la propiedad, planta y equipo, incluyendo reconocimiento, medición posterior y depreciación.</p><p>Los activos pueden medirse al costo o al modelo de revaluación, dependiendo de la política elegida por la empresa.</p><p>Las revelaciones requeridas son extensas y deben incluir metodologías de depreciación y vida útil estimada.</p>'),
'uploads/blog/articles/.jpg', FLOOR(RAND() * 500), FLOOR(RAND() * 50), 'aplicacion-de-la-nic-16-propiedad-planta-y-equipo-bajo-niif', NULL, 1, '["NIC 16","propiedad","planta","equipo","activos"]', 'Tratamiento contable de propiedad, planta y equipo bajo la NIC 16.', 2, 1, '2026-08-15 10:00:00', '2026-08-15 10:00:00');
