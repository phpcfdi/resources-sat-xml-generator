# Recursos con nombres incorrectos en el sitio del SAT

Al solicitar la descarga del archivo XSLT para CFDI 4.0, por dependencia intenta descargar el archivo XSLT
para el complemento de Pagos 2.0, sin embargo, la dirección utilizada no está disponible.

He podido corroborar que tanto el XSLT de CFDI 4.0, como la información oficial del SAT establecen la dirección
como `http://www.sat.gob.mx/sitio_internet/cfd/Pagos/Pagos20.xslt`. Sin embargo, fue publicada en
`http://www.sat.gob.mx/sitio_internet/cfd/Pagos/pagos20.xslt` (con minúscula).

Esto nos lleva a un problema al que se le ha propuesto una solución temporal, que consiste en poder
sobrescribir alguna (o varias) direcciones solicitadas y cambiarlas por otras utilizando el argumento
`--override="source-url real-url"`.
