<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\Retrievers;

use RuntimeException;

final class XmlRetrievers
{
    /** @var XmlRetriever[] */
    private $xmlRetrievers;

    public function __construct(XmlRetriever ...$xmlRetrievers)
    {
        $this->xmlRetrievers = $xmlRetrievers;
    }

    public function obtainRetrieverForUrl(string $sourceUrl): XmlRetriever
    {
        $extension = pathinfo($sourceUrl, PATHINFO_EXTENSION);
        foreach ($this->xmlRetrievers as $retriever) {
            if ($retriever->allowExtension($extension)) {
                return $retriever;
            }
        }
        throw new RuntimeException("Unable to find a retriever for url $sourceUrl");
    }
}
