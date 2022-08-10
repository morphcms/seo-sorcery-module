<?php

namespace Modules\SeoSorcery\Scanning;

use Modules\SeoSorcery\Contracts\ICanBeSeoAnalyzed;
use Modules\SeoSorcery\Contracts\ICanScan;
use Modules\SeoSorcery\Contracts\IRadar;

class Radar implements IRadar
{
    protected array $scanners = [];
    protected array $results = [];

    public function __construct(array $scanners = [])
    {
        $this->scanners = $scanners;
    }


    public function with(array $scanners): static
    {
        $this->scanners = $scanners;

        return $this;
    }

    public function add(string|array $scanners): static
    {
        $this->scanners = array_merge($this->scanners, is_array($scanners) ? $scanners : [$scanners]);

        return $this;
    }


    public function scan(ICanBeSeoAnalyzed $entity): static
    {

        $scanners = $this->resolveScanners();

        foreach ($scanners as $scanner) {
            $this->results[] = $scanner->scan($entity);
        }

        // Run tests
        return $this;
    }

    protected function resolveScanners(): \Illuminate\Support\Collection
    {
        return collect($this->scanners)->map(fn($scanner) => app($scanner));
    }


    public function results(): array
    {
        return $this->results;
    }
}
