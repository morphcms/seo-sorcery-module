<?php

namespace Modules\SeoSorcery\Services;

use Illuminate\Support\Collection;
use Modules\SeoSorcery\Contracts\ICanBeSeoAnalyzed;
use Modules\SeoSorcery\Contracts\ICanInspect;
use Modules\SeoSorcery\Contracts\ICanScan;
use Modules\SeoSorcery\Contracts\IScanResult;

class Sorcery
{
    private array $scanners;
    private array $inspectors;


    public function __construct(array $defaultScanners = [], array $defaultInspectors = [])
    {
        $this->scanners = $defaultScanners;
        $this->inspectors = $defaultInspectors;
    }

    public function registerInspector(string|array $inspectors): static
    {
        return $this->registerService($inspectors, $this->inspectors);
    }

    private function registerService(string|array $items, &$iterable): static
    {
        if (is_array($items)) {
            $iterable = array_merge($iterable, $items);

            return $this;
        }

        $iterable[] = $items;

        return $this;
    }

    /**
     * @deprecated Use Radar instead
     *
     * @param string|array $scanners
     * @return $this
     */
    public function registerScanner(string|array $scanners): static
    {
        return $this->registerService($scanners, $this->scanners);
    }

    /**
     * Inspects the website for generic SEO configuration
     *
     * @param string|ICanInspect|null $inspector
     * @return Collection|IScanResult
     */
    public function inspect(string|ICanInspect $inspector = null): Collection|IScanResult
    {
        if (!is_null($inspector)) {
            if ($inspector instanceof ICanInspect) {
                return $inspector->inspect();
            }

            return app($inspector)->inspect();
        }

        return collect($this->inspectors)->map(fn($inspector) => app($inspector)->inspect());
    }

    /**
     * @deprecated Use Radar instead
     *
     * @param ICanBeSeoAnalyzed|array $model
     * @param string|ICanScan|null $scanner
     * @return Collection|IScanResult
     */
    public function analyze(ICanBeSeoAnalyzed|array $model, string|ICanScan $scanner = null): Collection|IScanResult
    {
        if (!is_null($scanner)) {
            if ($scanner instanceof ICanScan) {
                return $scanner->scan($model);
            }

            return app($scanner)->scan($model);
        }

        // Run tests
        return $this->scanners()->map(fn($scanner) => app($scanner)->scan($model));
    }

    public function scanners(): Collection
    {
        return \Cache::remember('seo-sorcery.scanners', now()->addMinutes(5), fn() => collect($this->scanners));
    }
}
