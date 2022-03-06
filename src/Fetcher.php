<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator;

use Eclipxe\XmlResourceRetriever\XsdRetriever;
use Eclipxe\XmlResourceRetriever\XsltRetriever;
use PhpCfdi\ResourcesSatXmlGenerator\NsRegistry\Locations;
use PhpCfdi\ResourcesSatXmlGenerator\Retrievers\XmlRetriever;
use PhpCfdi\ResourcesSatXmlGenerator\Retrievers\XmlRetrievers;

class Fetcher
{
    /** @var ObserverInterface */
    private $observer;

    /** @var Downloader */
    private $downloader;

    public function __construct(ObserverInterface $observer)
    {
        $this->observer = $observer;
        $this->downloader = new Downloader($observer);
    }

    public function getDownloader(): Downloader
    {
        return $this->downloader;
    }

    public function fetch(string $destinationPath, Locations $locations): void
    {
        $xmlRetrievers = $this->createXmlRetrievers($destinationPath);

        foreach ($locations as $location) {
            if ('' === $location) {
                continue;
            }
            $this->observer->onFetch($location, $destinationPath);
            $xmlRetriever = $xmlRetrievers->obtainRetrieverForUrl($location);
            $xmlRetriever->retrieve($location);
        }
    }

    private function createXmlRetrievers(string $destinationPath): XmlRetrievers
    {
        return new XmlRetrievers(
            new XmlRetriever(new XsdRetriever($destinationPath, $this->downloader), 'xsd'),
            new XmlRetriever(new XsltRetriever($destinationPath, $this->downloader), 'xsl', 'xslt'),
        );
    }
}
