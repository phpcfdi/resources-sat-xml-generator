<?php

declare(strict_types=1);

namespace PhpCfdi\ResourcesSatXmlGenerator\NsRegistry;

use JsonException;
use RuntimeException;

final class NsRegistry
{
    /** @var NsEntry[] */
    private $entries;

    public function __construct(NsEntry ...$entries)
    {
        $this->entries = $entries;
    }

    public static function load(string $location): self
    {
        $contents = file_get_contents($location);
        if (false === $contents) {
            throw new RuntimeException("Unable to open $location");
        }
        try {
            /** @var mixed $baseEntries */
            $baseEntries = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
            if (! is_array($baseEntries)) {
                throw new RuntimeException('Namespace registry contents is not an array of entries');
            }
        } catch (JsonException $exception) {
            throw new RuntimeException('Namespace registry contents is not an array of entries', 0, $exception);
        }
        $entries = [];
        /** @var array<string, string|null> $entry */
        foreach ($baseEntries as $entry) {
            $entries[] = new NsEntry(
                strval($entry['xsd'] ?? ''),
                strval($entry['xslt'] ?? ''),
            );
        }
        return new self(...$entries);
    }

    /** @return string[] */
    public function obtainXsdLocations(): array
    {
        return array_map(function (NsEntry $entry): string {
            return $entry->getXsd();
        }, $this->entries);
    }

    /** @return string[] */
    public function obtainXsltLocations(): array
    {
        return array_map(function (NsEntry $entry): string {
            return $entry->getXslt();
        }, $this->entries);
    }

    public function obtainLocations(bool $includeXsd, bool $includeXslt, string ...$excludeLocations): Locations
    {
        $locations = new Locations();
        if ($includeXsd) {
            $locations = $locations->append(...$this->obtainXsdLocations());
        }
        if ($includeXslt) {
            $locations = $locations->append(...$this->obtainXsltLocations());
        }
        $locations = $locations->exclude(...$excludeLocations);
        return $locations;
    }
}
