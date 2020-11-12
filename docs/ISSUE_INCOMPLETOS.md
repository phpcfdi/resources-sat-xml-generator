# Recursos no disponibles en el sitio del SAT

*2020-06-15* Desconocemos exactamente la razón, pero comúnmente los archivos del SAT no se encuentran disponibles
o bien generan errores al generar las descargas.

*2020-11-12* Al parecer estos problemas se han corregido en el SAT, ya no he visto el problema

Al solicitar la url `http://www.sat.gob.mx/sitio_internet/cfd/catalogos/Nomina/catNomina.xsd` entrega un contenido
incompleto, que falla al momento de abrirlo como un archivo XML.

El error no sucede todo el tiempo, ni con los mismos recursos, *sospecho* de un error de configuración del SAT
o bien de un error de configuración de AWS CloudFront, dado el análisis de los headers en cada petición:

```
# Descarga correcta
curl -v -s -o catNomina.xsd http://www.sat.gob.mx/sitio_internet/cfd/catalogos/Nomina/catNomina.xsd
...
* Connected to www.sat.gob.mx (2600:9000:203e:0:10:a6f6:bf80:93a1) port 80 (#0)
< Content-Length: 14567
< Last-Modified: Wed, 08 Apr 2020 21:16:43 GMT
< ETag: "{D4CC913A-7A73-41ED-A852-C3A279AAD9F8},3pub"
...

# Descarga incompleta
curl -v -s -o catNomina.xsd http://www.sat.gob.mx/sitio_internet/cfd/catalogos/Nomina/catNomina.xsd
...
* Connected to www.sat.gob.mx (2600:9000:203e:7600:10:a6f6:bf80:93a1) port 80 (#0)
< Content-Length: 14530
< Last-Modified: Wed, 11 Dec 2019 16:26:58 GMT
< ETag: "{D4CC913A-7A73-41ED-A852-C3A279AAD9F8},4pub"
...
```
