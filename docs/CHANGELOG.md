# CHANGELOG

## SemVer 2.0

Utilizamos [Versionado Semántico 2.0.0](SEMVER.md).

## Versión 1.1.0 2020-08-16

- Se quita el header `Accept-Encoding`, esto lleva a problemas en la descarga con el cliente HTTP de Symfony.
- Se compatibiliza `DownloadException` para que acepte la excepción previa como nula.
- Se corrige la descripción del proyecto.
- Se corrige la descripción del parámetro `type` en `fetch:sat`.
- Se omite el contenido de `build/`.

## Versión 1.0.0 2020-06-21

- Versión inicial
