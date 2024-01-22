<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\CLI;

use Exception;
use PhpCfdi\ResourcesSatXmlGenerator\Fetcher;
use PhpCfdi\ResourcesSatXmlGenerator\NsRegistry\NsRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class FetchSatCommand extends Command
{
    public const NS_REGISTRY = 'https://raw.githubusercontent.com/phpcfdi/sat-ns-registry/master/complementos_v1.json';

    protected static $defaultName = 'fetch:sat';

    protected function configure(): void
    {
        $this->setDescription('Fetch the XSD collection files from SAT Registry, see ' . self::NS_REGISTRY);
        $this->setDefinition(
            new InputDefinition([
                new InputOption('ns-registry', 'r', InputOption::VALUE_REQUIRED, 'Namespace registry location'),
                new InputOption('ignore', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Ignore location'),
                new InputOption('override', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Override location (source => destination)'),
                new InputArgument('destination-path', InputArgument::REQUIRED, 'Path to store the resources'),
                new InputArgument('type', InputArgument::OPTIONAL, 'Fetch type: all, xsd or xslt'),
            ]),
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string|null $type */
        $type = $input->getArgument('type');
        $type = strtolower($type ?? '' ?: 'all');
        if (! in_array($type, ['all', 'xsd', 'xslt'], true)) {
            throw new Exception('Argument type (optional) must be one of all, xsd or xslt');
        }
        $downloadXsd = in_array($type, ['all', 'xsd'], true);
        $downloadXslt = in_array($type, ['all', 'xslt'], true);
        /** @var string $registryLocation */
        $registryLocation = $input->getOption('ns-registry') ?: self::NS_REGISTRY;
        /** @var string $destinationPath */
        $destinationPath = $input->getArgument('destination-path');
        /** @var string[] $ignoredLocations */
        $ignoredLocations = $input->getOption('ignore');
        /** @var string[] $overridePairs */
        $overridePairs = $input->getOption('override');

        $registry = NsRegistry::load($registryLocation);
        $locations = $registry->obtainLocations($downloadXsd, $downloadXslt, ...$ignoredLocations);

        $fetcher = new Fetcher(new OutputObserver($output));
        $fetcher->getDownloader()->setOverridePairs(...$overridePairs);
        $fetcher->fetch($destinationPath, $locations);

        return 0;
    }
}
