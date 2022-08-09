<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\Tests\Integration;

use PhpCfdi\ResourcesSatXmlGenerator\CLI\Application;
use PhpCfdi\ResourcesSatXmlGenerator\Tests\TestCase;
use Symfony\Component\Console\Tester\ApplicationTester;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * This test case create the application using specific arguments,
 * then run fetch:sat using a fake registry and storing all the data
 * into a temporary folder, it expects that all xml files were downloaded.
 *
 * Important:
 *  - Is using local php web server http://localhost:8999/ using tests/_files/public/ as docroot
 *  - The temporary created folder is removed on test case tear down
 *  - Is not using the global namespace registry, is using a fake located at http://localhost:8999/registry.json
 */
final class FakeDownloadTest extends TestCase
{
    public function testAllXmlFiles(): void
    {
        $registryUrl = $this->urlTest('registry.json');
        $temporaryFolder = $this->createFolderForTest();

        $arguments = [
            'command' => 'fetch:sat',
            '--ns-registry' => $registryUrl,
            'destination-path' => $temporaryFolder,
            'type' => 'all',
        ];

        $application = new Application();
        $application->setAutoExit(false);
        $tester = new ApplicationTester($application);
        $tester->run($arguments);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringNotContainsString('FAIL', $tester->getDisplay());

        $finder = new Finder();
        $testDirectory = dirname(__DIR__);
        $finder->files()->in($testDirectory . '/_files/public/xml/');
        $expectedFiles = array_map(
            fn (SplFileInfo $file): string => str_replace($testDirectory . '/_files/public/', '/localhost/', $file->getPathname()),
            iterator_to_array($finder),
        );

        foreach ($expectedFiles as $expectedFile) {
            $this->assertFileExists($temporaryFolder . $expectedFile);
        }
    }
}
