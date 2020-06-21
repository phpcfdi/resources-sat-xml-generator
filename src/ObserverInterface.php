<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator;

interface ObserverInterface
{
    public function onFetch(string $sourceUrl, string $destinationPath): void;

    public function onDownload(string $source, string $destination): void;

    public function onSkip(string $source, string $destination): void;

    public function onSuccess(string $source, string $destination): void;

    public function onError(DownloaderException $exception): void;
}
