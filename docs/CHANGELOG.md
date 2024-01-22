# CHANGELOG

## SemVer 2.0

Utilizamos [Versionado Semántico 2.0.0](SEMVER.md).

## Mantenimiento 2024-01-22

- Se actualiza la imagen de docker para que esté basada en PHP 8.3.
- Se cambia el archivo de licencia. ¡Feliz 2024!
- Se corrige el ancla del proyecto en el archivo `CONTRIBUTING.md`.
- Se actualiza el archivo de configuración de `php-cs-fixer`.
- Se actualizan los flujos de trabajo de GitHub:
  - Se agrega PHP 8.3 a la matriz de pruebas.
  - Se ejecutan los flujos de trabajo en PHP 8.3.
  - Se permite ejecutar manualmente el flujo de trabajo.
- Se actualizan las herramientas de desarrollo.

## Versión 2.0.1 2023-01-30

- Se corrige un posible bug en `Downloader` al dividir un texto en dos partes.
  La segunda parte podría no existir y no estaba tratado correctamente.
- Se le da mantenimiento al proyecto:
  - Actualización de licencia. Feliz 2023.
  - Actualización del emblema de construcción.
  - Se agrega PHP 8.2 a la matrix de pruebas.
  - Se usa PHP 8.2 en la mayoría de los flujos de trabajo.
  - Se actualizan las herramientas de desarrollo.
  - Se actualizan las configuraciones de revisión y corrección de estilo de código.

## Versión 2.0.0 2022-03-06

Se actualiza la versión de `eclipxe/xmlresourceretriever` a `2.0`.
Esto rompe la compatibilidad porque las clases cambian de dependencias en el espacio de nombres.

Se actualiza el requerimiento de PHP para usar la versión mínima 8.0.
De igual forma, las dependencias a los componentes de Symfony cambian su versión mínima a 6.0.

Se usa *temporalmente* [`rector`](https://getrector.org/) para cambiar el código del proyecto a PHP 8.0.

Se corrige el proceso de construcción de cobertura de código en Scrutinizer-CI.

Se organiza la carpeta de pruebas `tests` estableciendo el tipo de prueba (integración o unitaria)
y moviendo los archivos de trabajo a la carpeta `tests/_files`.

Se actualiza el flujo de trabajo de integración continua.

Se actualizan las herramientas de desarrollo.

## Unreleased 2022-02-22

Se corrige el archivo de configuración de `psalm.xml.dist` porque el atributo `totallytyped` ha sido deprecado.

## Versión 1.2.0 2022-01-02

- Se agrega la opción para poder sobreescribir el origen de un recurso a descargar `--override="source-url override-url"`.
  Esta opción es importante porque el SAT tiene incorrectamente publicada la ubicación
  de *Pagos 2.0*, donde la dirección `http://www.sat.gob.mx/sitio_internet/cfd/Pagos/Pagos20.xslt`
  se encuentra realmente en `http://www.sat.gob.mx/sitio_internet/cfd/Pagos/pagos20.xslt`.

Se han agregado diversas actualizaciones al entorno de desarrollo:

- Se actualiza el archivo de licencia, Feliz 2022.
- Se cambia el nombre de la versión principal de `master` a `main`.
- Se cambia la dependencia de desarrollo de `fzaninotto/faker` a `fakerphp/faker`
- Se cambia el administrador de herramientas de desarrollo a `phive`.
- Se actualiza `php-cs-fixer` y su archivo de configuración.
- Se migra la CI de Travis CI a GitHub Workflows.
- Se actualiza el archivo de configuración de PHPUnit.
- Se actualiza el código de conducta.
- Se actualiza el archivo de guía de contribución.
- Se renombra el archivo de configuración de Psalm.
- Se cambió la imagen de Docker de PHP 7.4 a PHP 8.0.

## Versión 1.1.2 2021-11-19

- Algunos registros de espacios de nombres podrían tener la dirección vacía,
  como en el caso de *Carta Porte 2.0* donde aún no está publicada la dirección
  del archivo XSLT. Se modifica para que cuando la dirección no existe entonces
  simplemente sea ignorada.

## Versión 1.1.1 2021-01-08

- Actualización del año en la licencia, ¡feliz 2021 desde PhpCfdi!
- Los comandos de `composer dev:*` se ejecutan usando `@php`.
- Se corrige el build porque `psalm` detecta que el método `OutputObserver::onFetch` no está
  respetando el nombre de los argumentos de la interfaz. Es una medida preventiva a PHP 8.0.
- Se actualiza `develop/install-development-tools` a la versión 0.0.20201110.
- Se corrigen algunas faltas ortográficas del archivo README.
- Actualización y traducción del código de conducta.
- Actualización y traducción de la guía de contribución.
- Se actualiza el proceso de construcción en Travis-CI y Scrutinizer.

## Versión 1.1.0 2020-08-16

- Se quita el header `Accept-Encoding`, esto lleva a problemas en la descarga con el cliente HTTP de Symfony.
- Se compatibiliza `DownloadException` para que acepte la excepción previa como nula.
- Se corrige la descripción del proyecto.
- Se corrige la descripción del parámetro `type` en `fetch:sat`.
- Se omite el contenido de `build/`.

## Versión 1.0.0 2020-06-21

- Versión inicial
