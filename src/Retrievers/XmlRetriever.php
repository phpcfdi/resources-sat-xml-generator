<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\Retrievers;

use XmlResourceRetriever\RetrieverInterface;

final class XmlRetriever
{
    /** @var RetrieverInterface */
    private $retriever;

    /** @var string[] */
    private $extensions;

    public function __construct(RetrieverInterface $retriever, string ...$extensions)
    {
        $this->retriever = $retriever;
        $this->extensions = $extensions;
    }

    public function allowExtension(string $extension): bool
    {
        return in_array($extension, $this->extensions, true);
    }

    public function retrieve(string $sourceUrl): void
    {
        $this->retriever->retrieve($sourceUrl);
    }
}
