<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\CLI;

use Symfony\Component\Console\Application as SymfonyApplication;

class Application extends SymfonyApplication
{
    public function __construct()
    {
        parent::__construct('resources-sat-xml-generator', '1.2.0');
        $this->add(new FetchSatCommand());
        $this->add(new FetchCommand());
    }
}
