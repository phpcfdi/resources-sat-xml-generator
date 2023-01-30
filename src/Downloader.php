<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator;

use Eclipxe\XmlResourceRetriever\Downloader\DownloaderInterface;
use Exception;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

final class Downloader implements DownloaderInterface
{
    private HttpClientInterface $httpClient;

    /** @var array<string, string> */
    private array $overrides = [];

    public function __construct(private ObserverInterface $observer, ?HttpClientInterface $httpClient = null)
    {
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
            $response = $this->httpClient->request('GET', $this->getOverride($source), [
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

    public function setOverridePairs(string ...$overridePairs): void
    {
        foreach ($overridePairs as $overridePair) {
            $overridePair = (string) preg_replace('/\s+/', ' ', $overridePair);
            $overridePairParts = explode(' ', $overridePair, 2);
            if (! isset($overridePairParts[0], $overridePairParts[1])) {
                continue;
            }
            [$source, $override] = $overridePairParts;
            $this->setOverride($source, $override);
        }
    }

    public function setOverride(string $source, string $override): void
    {
        if ($source === $override || '' === $override || str_contains($override, ' ')) {
            return;
        }

        $this->overrides[$source] = $override;
    }

    private function getOverride(string $source): string
    {
        return $this->overrides[$source] ?? $source;
    }
}
