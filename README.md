# `phpcfdi/resources-sat-xml-generator`

[![Source Code][badge-source]][source]
[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![Build Status][badge-build]][build]
[![Scrutinizer][badge-quality]][quality]
[![Coverage Status][badge-coverage]][coverage]
[![Total Downloads][badge-downloads]][downloads]

> Programa PHP para generar los recursos desde los archivos XSD y XSLT del SAT para CFDI.

:us: The documentation of this project is in spanish as this is the natural language for intented audience.

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
los archivos pertenecerán a el usuario que está ejecutando el comando:

```shell
docker run -it --rm --volume /tmp/output:/tmp/output --user="$(id -u):$(id -g)" \
    resources-sat-xml-generator fetch:sat /tmp/output
```

## Problemas conocidos

- [Indisponibilidad de recursos en el sitio del SAT](docs/ISSUE_INCOMPLETOS.md)

## Soporte

Puedes obtener soporte abriendo un ticker en Github.

Adicionalmente, esta librería pertenece a la comunidad [PhpCfdi](https://www.phpcfdi.com), así que puedes usar los
mismos canales de comunicación para obtener ayuda de algún miembro de la comunidad.

## Compatilibilidad

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
y recuerda revisar el archivo de tareas pendientes [TODO][] y el [CHANGELOG][].

## Copyright and License

The `phpcfdi/resources-sat-xml-generator` library is copyright © [PhpCfdi](https://www.phpcfdi.com)
and licensed for use under the MIT License (MIT). Please see [LICENSE][] for more information.


[contributing]: https://github.com/phpcfdi/resources-sat-xml-generator/blob/master/CONTRIBUTING.md
[changelog]: https://github.com/phpcfdi/resources-sat-xml-generator/blob/master/docs/CHANGELOG.md
[todo]: https://github.com/phpcfdi/resources-sat-xml-generator/blob/master/docs/TODO.md

[source]: https://github.com/phpcfdi/resources-sat-xml-generator
[release]: https://github.com/phpcfdi/resources-sat-xml-generator/releases
[license]: https://github.com/phpcfdi/resources-sat-xml-generator/blob/master/LICENSE
[build]: https://travis-ci.com/phpcfdi/resources-sat-xml-generator?branch=master
[quality]: https://scrutinizer-ci.com/g/phpcfdi/resources-sat-xml-generator/
[coverage]: https://scrutinizer-ci.com/g/phpcfdi/resources-sat-xml-generator/code-structure/master/code-coverage
[downloads]: https://packagist.org/packages/phpcfdi/resources-sat-xml-generator

[badge-source]: http://img.shields.io/badge/source-phpcfdi/resources--sat--xml--generator-blue?style=flat-square
[badge-release]: https://img.shields.io/github/release/phpcfdi/resources-sat-xml-generator?style=flat-square
[badge-license]: https://img.shields.io/github/license/phpcfdi/resources-sat-xml-generator?style=flat-square
[badge-build]: https://img.shields.io/travis/com/phpcfdi/resources-sat-xml-generator/master?style=flat-square
[badge-quality]: https://img.shields.io/scrutinizer/g/phpcfdi/resources-sat-xml-generator/master?style=flat-square
[badge-coverage]: https://img.shields.io/scrutinizer/coverage/g/phpcfdi/resources-sat-xml-generator/master?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/phpcfdi/resources-sat-xml-generator?style=flat-square
