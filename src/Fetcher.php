<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator;

use PhpCfdi\ResourcesSatXmlGenerator\NsRegistry\Locations;
use PhpCfdi\ResourcesSatXmlGenerator\Retrievers\XmlRetriever;
use PhpCfdi\ResourcesSatXmlGenerator\Retrievers\XmlRetrievers;
use XmlResourceRetriever\XsdRetriever;
use XmlResourceRetriever\XsltRetriever;

class Fetcher
{
    /** @var ObserverInterface */
    private $observer;

    public function __construct(ObserverInterface $observer)
    {
        $this->observer = $observer;
    }

    public function fetch(string $destinationPath, Locations $locations): void
    {
        $xmlRetrievers = $this->createXmlRetrievers($destinationPath);

        foreach ($locations as $location) {
            $this->observer->onFetch($location, $destinationPath);
            $xmlRetriever = $xmlRetrievers->obtainRetrieverForUrl($location);
            $xmlRetriever->retrieve($location);
        }
    }

    private function createXmlRetrievers(string $destinationPath): XmlRetrievers
    {
        $downloader = new Downloader($this->observer);
        return new XmlRetrievers(
            new XmlRetriever(new XsdRetriever($destinationPath, $downloader), 'xsd'),
            new XmlRetriever(new XsltRetriever($destinationPath, $downloader), 'xsl', 'xslt'),
        );
    }
}
