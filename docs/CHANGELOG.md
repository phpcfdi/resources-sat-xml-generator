# CHANGELOG

## SemVer 2.0

Utilizamos [Versionado Semántico 2.0.0](SEMVER.md).

## Versión 1.1.1 2021-01-08

- Actualización del año en la licencia, ¡feliz 2021 desde PhpCfdi!
- Los comandos de `composer dev:*` se ejecutan usando `@php`.
- Se corrige el build porque `psalm` detecta que el método `OutputObserver::onFetch` no está
  respetando el nombre de los argumentos de la interfaz. Es una medida preventiva a PHP 8.0.
- Se actualiza `develop/install-development-tools` a la versión 0.0.20201110.
- Se corrigen algunas faltas ortográficas del archivo README.
- Actualización y traducción del código de conducta.
- Actualización y traducción de la guía de contribución.

## Versión 1.1.0 2020-08-16

- Se quita el header `Accept-Encoding`, esto lleva a problemas en la descarga con el cliente HTTP de Symfony.
- Se compatibiliza `DownloadException` para que acepte la excepción previa como nula.
- Se corrige la descripción del proyecto.
- Se corrige la descripción del parámetro `type` en `fetch:sat`.
- Se omite el contenido de `build/`.

## Versión 1.0.0 2020-06-21

- Versión inicial
