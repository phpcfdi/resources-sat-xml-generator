<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\NsRegistry;

final readonly class NsEntry
{
    public function __construct(private string $xsd, private string $xslt)
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
