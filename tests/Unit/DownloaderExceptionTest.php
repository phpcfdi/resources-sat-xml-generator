<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\Tests\Unit;

use PhpCfdi\ResourcesSatXmlGenerator\DownloaderException;
use PhpCfdi\ResourcesSatXmlGenerator\Tests\TestCase;
use Throwable;

final class DownloaderExceptionTest extends TestCase
{
    public function testConstructAndProperties(): void
    {
        $message = 'Unable to download [source] to [destination]';
        $source = '[source]';
        $destination = '[destination]';
        $previous = $this->createMock(Throwable::class);

        $exception = new DownloaderException($source, $destination, $previous);

        $this->assertSame($source, $exception->getSource());
        $this->assertSame($destination, $exception->getDestination());
        $this->assertSame($previous, $exception->getPrevious());
        $this->assertSame($message, $exception->getMessage());
    }
}
