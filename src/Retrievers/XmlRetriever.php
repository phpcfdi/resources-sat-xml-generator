<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\Retrievers;

use Eclipxe\XmlResourceRetriever\RetrieverInterface;

final readonly class XmlRetriever
{
    /** @var string[] */
    private array $extensions;

    public function __construct(private RetrieverInterface $retriever, string ...$extensions)
    {
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
