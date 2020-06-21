<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\NsRegistry;

final class NsEntry
{
    /** @var string */
    private $xsd;

    /** @var string */
    private $xslt;

    public function __construct(string $xsd, string $xslt)
    {
        $this->xsd = $xsd;
        $this->xslt = $xslt;
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
