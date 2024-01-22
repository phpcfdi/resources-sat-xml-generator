<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\NsRegistry;

final class NsEntry
{
    public function __construct(private readonly string $xsd, private readonly string $xslt)
    {
    }

    public function getXsd(): string
    {
        return $this->xsd;
    }

    public function getXslt(): string
    {
        return $this->xslt;
    }
}
