<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\CLI;

use PhpCfdi\ResourcesSatXmlGenerator\Fetcher;
use PhpCfdi\ResourcesSatXmlGenerator\NsRegistry\Locations;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class FetchCommand extends Command
{
    protected static $defaultName = 'fetch:urls';

    protected function configure(): void
    {
        $this->setDescription('Fetch xsd or xslt resources and store them on destination folder');
        $this->setDefinition(
            new InputDefinition([
                new InputArgument('destination-path', InputArgument::REQUIRED, 'Path to store the resources'),
                new InputArgument('source-url', InputArgument::REQUIRED | InputArgument::IS_ARRAY, 'Source URL to download'),
            ])
        );
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string $destinationPath */
        $destinationPath = $input->getArgument('destination-path');

        /** @var string[] $sourceUrls */
        $sourceUrls = $input->getArgument('source-url');
        $sourceUrls = array_filter($sourceUrls);
        $locations = new Locations(...$sourceUrls);

        $fetcher = new Fetcher(new OutputObserver($output));
        $fetcher->fetch($destinationPath, $locations);

        return 0;
    }
}
