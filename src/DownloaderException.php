<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator;

use Exception;
use Throwable;

class DownloaderException extends Exception
{
    private string $source;

    private string $destination;

    public function __construct(string $source, string $destination, Throwable $previous = null)
    {
        parent::__construct("Unable to download $source to $destination", 0, $previous);
        $this->source = $source;
        $this->destination = $destination;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }
}
