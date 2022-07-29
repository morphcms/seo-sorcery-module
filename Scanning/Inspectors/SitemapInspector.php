<?php

namespace Modules\SeoSorcery\Scanning\Inspectors;

use Illuminate\Support\Facades\Http;
use Modules\SeoSorcery\Contracts\IScanResult;
use Modules\SeoSorcery\Scanning\Inspector;
use Modules\SeoSorcery\Scanning\ScanResult;

class SitemapInspector extends Inspector
{

    public function inspect(): IScanResult
    {
        $report = ScanResult::make(__('Sitemap Inspector'));

        if ($this->checkFileNotExists()) {
            return $report
                ->message(__('Sitemap does not exists.'))
                ->help(__('You can generate a new sitemap by running the action within your SEO panel.'));
        }

        if ($this->checkIfCannotBeAccessed()) {
            return $report
                ->message(__('Sitemap exists, but it cannot be accessed. '))
                ->help(__('Please, make sure that all the permissions are set correctly.'));
        }


        return $report->status(passed: true)->message(__('One or more sitemaps exists.'));
    }

    private function checkFileNotExists(): bool
    {
        return !file_exists(public_path('sitemap.xml'));
    }

    private function checkIfCannotBeAccessed(): bool
    {
        return !Http::get(url('/sitemap.xml'))->ok();
    }
}
