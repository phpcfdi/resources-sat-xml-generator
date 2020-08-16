<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator;

use Exception;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;
use XmlResourceRetriever\Downloader\DownloaderInterface;

final class Downloader implements DownloaderInterface
{
    /** @var HttpClientInterface */
    private $httpClient;

    /** @var ObserverInterface */
    private $observer;

    public function __construct(ObserverInterface $observer, ?HttpClientInterface $httpClient = null)
    {
        $this->observer = $observer;
        $this->httpClient = $httpClient ?? HttpClient::create();
    }

    public function downloadTo(string $source, string $destination): void
    {
        try {
            $this->observer->onDownload($source, $destination);
            if (file_exists($destination)) {
                $this->observer->onSkip($source, $destination);
                return;
            }
            $response = $this->httpClient->request('GET', $source, [
                'headers' => [
                    'dnt' => '1', // do not track
                    'Accept' => 'application/xml',
                    'Accept-Charset' => 'utf-8',
                    'Cache-Control' => 'no-transform',
                ],
            ]);
            $stream = $response->getContent();
            if (false === file_put_contents($destination, $stream)) {
                throw new Exception("Unable to write $destination");
            }
            $this->observer->onSuccess($source, $destination);
        } catch (Throwable $exception) {
            $exception = new DownloaderException($source, $destination, $exception);
            $this->observer->onError($exception);
            throw $exception;
        }
    }
}
