<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:books="http://test.org/schemas/books" xmlns:items="http://test.org/schemas/items">
    <xsl:include href="http://localhost:8999/xml/items.xslt"/>
    <xsl:include href="http://localhost:8999/xml/articles/books.xslt"/>
    <xsl:template match="/">
        <h1>Ticket</h1>
        <p><span><xsl:value-of select="@total"/></span></p>
        <xsl:apply-templates select="/books:books"/>
        <xsl:apply-templates select="/items:items"/>
    </xsl:template>
</xsl:stylesheet>
