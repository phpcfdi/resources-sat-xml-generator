<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\Tests;

use LogicException;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    /** @var string[] */
    private array $temporaryFolders;

    public function urlTest(string $path): string
    {
        return 'http://localhost:8999/' . ltrim($path, '/');
    }

    public function createFolderForTest(): string
    {
        $command = sprintf('mktemp --directory --tmpdir=%s', escapeshellarg($this->localBuildDir()));
        $temporaryFolder = trim(strval(shell_exec($command)));
        if ('' === $temporaryFolder) {
            throw new LogicException("Unable to create temporary folder on {$this->localBuildDir()}");
        }
        $this->temporaryFolders[] = $temporaryFolder;
        return $temporaryFolder;
    }

    public function localBuildDir(): string
    {
        return realpath(__DIR__ . '/../build/') ?: '';
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->temporaryFolders = [];
    }

    protected function tearDown(): void
    {
        foreach ($this->temporaryFolders as $temporaryFolder) {
            $command = sprintf('rm -rf %s', escapeshellarg($temporaryFolder));
            shell_exec($command);
        }
        parent::tearDown();
    }
}
