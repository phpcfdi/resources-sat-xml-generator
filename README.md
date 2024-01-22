# `phpcfdi/resources-sat-xml-generator`

[![Source Code][badge-source]][source]
[![Packagist PHP Version Support][badge-php-version]][php-version]
[![Discord][badge-discord]][discord]
[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![Build Status][badge-build]][build]
[![Reliability][badge-reliability]][reliability]
[![Maintainability][badge-maintainability]][maintainability]
[![Code Coverage][badge-coverage]][coverage]
[![Violations][badge-violations]][violations]
[![Total Downloads][badge-downloads]][downloads]

> Programa PHP para generar los recursos desde los archivos XSD y XSLT del SAT para CFDI.

:us: The documentation of this project is in spanish as this is the natural language for the intended audience.

Este proyecto fue creado con el propósito de generar una copia local utilizable de los archivos XSD y XSLT del SAT.

Para generar la copia local utiliza [`eclipxe/xmlresourceretriever`](https://github.com/eclipxe13/XmlResourceRetriever)
y de esta manera los archivos descargados contienen referencias relativas y no referencias absolutas.

Utiliza [phpcfdi/sat-ns-registry](https://github.com/phpcfdi/sat-ns-registry) para tener un registro completo de todos
los archivos XSD y XSLT que ofrece el SAT, el cual contiene la información de CFDI en todas sus versiones así como
de los complementos en sus múltiples versiones.

Esta herramienta se utiliza para la creación de los recursos compartidos en el repositorio
[phpcfdi/resources-sat-xml](https://github.com/phpcfdi/resources-sat-xml).

## Instalación

Usa [composer](https://getcomposer.org/)

```shell
composer require phpcfdi/resources-sat-xml-generator
```

También puedes descargarlo, instalar las dependencias y utilizarlo

```shell
git clone https://github.com/phpcfdi/resources-sat-xml-generator resources-sat-xml-generator
cd resources-sat-xml-generator
composer install
php bin/resources-sat-xml-generator fetch:sat xml-resources/ all
```

## Uso básico

```shell
php bin/resources-sat-xml-generator fetch http://...
```

## Uso con `docker`

En el repositorio se encuentran los archivos para construir la *imagen* de docker y así ejecutar el *contenedor*.

Para construir la imagen con el nombre `resources-sat-xml-generator`:

```shell
git clone https://github.com/phpcfdi/resources-sat-xml-generator.git
docker build resources-sat-xml-generator -t resources-sat-xml-generator
```

Para ejecutar la imagen generando los archivos en `/tmp/output`,
los archivos pertenecerán al usuario que está ejecutando el comando:

```shell
docker run -it --rm --volume /tmp/output:/tmp/output --user="$(id -u):$(id -g)" \
    resources-sat-xml-generator fetch:sat /tmp/output
```

## Problemas conocidos

- [Recursos no disponibles en el sitio del SAT](docs/ISSUE_INCOMPLETOS.md)
- [Recursos con nombres incorrectos en el sitio del SAT](docs/ISSUE_RESOURCES_NAMES.md)

## Soporte

Puedes obtener soporte abriendo un ticket en Github.

Adicionalmente, esta librería pertenece a la comunidad [PhpCfdi](https://www.phpcfdi.com), así que puedes usar los
mismos canales de comunicación para obtener ayuda de algún miembro de la comunidad.

## Compatibilidad

Esta librería se mantendrá compatible con al menos la versión con
[soporte activo de PHP](https://www.php.net/supported-versions.php) más reciente.

También utilizamos [Versionado Semántico 2.0.0](docs/SEMVER.md) por lo que puedes usar esta librería
sin temor a romper tu aplicación.

## Acerca de este proyecto

Este recurso se crea dentro de la iniciativa de [PhpCfdi](https://www.phpcfdi.com) para contar con información pública del
SAT pero de forma descentralizada, con control de cambios y utilizable en formatos abiertos para sistemas informáticos.

Estos recursos, a pesar de estar vinculados con una tecnología en su formato, no están vinculados con un lenguaje
de programación o una librería específica para su consumo. Cualquier proyecto, privado o público, desde cualquier
lenguaje de programación, arquitectura o tecnología debe ser capaz de explotarlo siempre que pueda utilizar el
formato de almacenamiento.

## Contribuciones

Las contribuciones con bienvenidas. Por favor lee [CONTRIBUTING][] para más detalles
y recuerda revisar el archivo de tareas pendientes [TODO][] y el archivo [CHANGELOG][].

## Copyright and License

The `phpcfdi/resources-sat-xml-generator` library is copyright © [PhpCfdi](https://www.phpcfdi.com)
and licensed for use under the MIT License (MIT). Please see [LICENSE][] for more information.


[contributing]: https://github.com/phpcfdi/resources-sat-xml-generator/blob/main/CONTRIBUTING.md
[changelog]: https://github.com/phpcfdi/resources-sat-xml-generator/blob/main/docs/CHANGELOG.md
[todo]: https://github.com/phpcfdi/resources-sat-xml-generator/blob/main/docs/TODO.md

[source]: https://github.com/phpcfdi/resources-sat-xml-generator
[php-version]: https://packagist.org/packages/phpcfdi/resources-sat-xml-generator
[discord]: https://discord.gg/aFGYXvX
[release]: https://github.com/phpcfdi/resources-sat-xml-generator/releases
[license]: https://github.com/phpcfdi/resources-sat-xml-generator/blob/main/LICENSE
[build]: https://github.com/phpcfdi/resources-sat-xml-generator/actions/workflows/build.yml?query=branch:main
[reliability]:https://sonarcloud.io/component_measures?id=phpcfdi_resources-sat-xml-generator&metric=Reliability
[maintainability]: https://sonarcloud.io/component_measures?id=phpcfdi_resources-sat-xml-generator&metric=Maintainability
[coverage]: https://sonarcloud.io/component_measures?id=phpcfdi_resources-sat-xml-generator&metric=Coverage
[violations]: https://sonarcloud.io/project/issues?id=phpcfdi_resources-sat-xml-generator&resolved=false
[downloads]: https://packagist.org/packages/phpcfdi/resources-sat-xml-generator

[badge-source]: http://img.shields.io/badge/source-phpcfdi/resources--sat--xml--generator-blue?logo=github
[badge-php-version]: https://img.shields.io/packagist/php-v/phpcfdi/resources-sat-xml-generator?logo=php
[badge-discord]: https://img.shields.io/discord/459860554090283019?logo=discord
[badge-release]: https://img.shields.io/github/release/phpcfdi/resources-sat-xml-generator?logo=git
[badge-license]: https://img.shields.io/github/license/phpcfdi/resources-sat-xml-generator?logo=open-source-initiative
[badge-build]: https://img.shields.io/github/actions/workflow/status/phpcfdi/resources-sat-xml-generator/build.yml?branch=main&logo=github-actions
[badge-reliability]: https://sonarcloud.io/api/project_badges/measure?project=phpcfdi_resources-sat-xml-generator&metric=reliability_rating
[badge-maintainability]: https://sonarcloud.io/api/project_badges/measure?project=phpcfdi_resources-sat-xml-generator&metric=sqale_rating
[badge-coverage]: https://img.shields.io/sonar/coverage/phpcfdi_resources-sat-xml-generator/main?logo=sonarcloud&server=https%3A%2F%2Fsonarcloud.io
[badge-violations]: https://img.shields.io/sonar/violations/phpcfdi_resources-sat-xml-generator/main?format=long&logo=sonarcloud&server=https%3A%2F%2Fsonarcloud.io
[badge-downloads]: https://img.shields.io/packagist/dt/phpcfdi/resources-sat-xml-generator?logo=packagist
