<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\CLI;

use PhpCfdi\ResourcesSatXmlGenerator\DownloaderException;
use PhpCfdi\ResourcesSatXmlGenerator\ObserverInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class OutputObserver implements ObserverInterface
{
    /** @var OutputInterface */
    private $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function onFetch(string $sourceUrl, string $destinationPath): void
    {
        $this->output->writeln("<info>Fetching $sourceUrl to $destinationPath</info>");
    }

    public function onDownload(string $source, string $destination): void
    {
        $this->output->write("Downloading $source to $destination ... ");
    }

    public function onSkip(string $source, string $destination): void
    {
        $this->output->writeln('SKIP');
    }

    public function onSuccess(string $source, string $destination): void
    {
        $this->output->writeln('OK');
    }

    public function onError(DownloaderException $exception): void
    {
        $this->output->writeln('FAIL');
    }
}
