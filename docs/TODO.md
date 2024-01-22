# phpcfdi/resources-sat-xml-generator To Do List

Liste en este archivo los posibles cambios futuros e ideas pendientes.

## Tipo de datos de constantes

A la fecha 2024-01-22 la herramienta `phpcs` no detecta correctamente los tipos en las constantes de PHP 8.3, 
por lo que no se han agregado. En cuanto se corrija este problema, se debe agregar el tipo de datos.
Por ejemplo en `PhpCfdi\ResourcesSatXmlGenerator\CLI\FetchSatCommand::NS_REGISTRY`.
