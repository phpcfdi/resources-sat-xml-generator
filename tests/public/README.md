Use this folder to perform tests, is the public root folder for PHP internal web server.

```shell
php -S 127.0.0.1:8999 -t tests/public/
```

The port number `8999` is hardcoded and every file inside `public/` that links to another file is using the
same port number.

The XML *structure and hierarchy* is:

```text

ticket
  |-- items
  |-- books

ns: http://test.org/schemas/ticket
xsd: http://localhost:8999/xml/items.xsd
xslt: http://localhost:8999/xml/items.xslt

ns: http://test.org/schemas/books
xsd: http://localhost:8999/xml/articles/books.xsd
xslt: http://localhost:8999/xml/articles/books.xslt

ns: http://test.org/schemas/ticket
xsd: http://localhost:8999/xml/entities/ticket.xsd
xslt: http://localhost:8999/xml/entities/ticket.xslt

``` 
