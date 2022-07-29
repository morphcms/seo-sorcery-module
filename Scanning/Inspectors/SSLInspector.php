<?php

namespace Modules\SeoSorcery\Scanning\Inspectors;

use Http\Client\Exception\RequestException;
use Illuminate\Support\Facades\Http;
use Modules\SeoSorcery\Contracts\IScanResult;
use Modules\SeoSorcery\Scanning\Inspector;
use Modules\SeoSorcery\Scanning\ScanResult;

class SSLInspector extends Inspector
{
    public function inspect(): IScanResult
    {
        $report = ScanResult::make(__('SSL Inspector'));

        try {
            Http::get(url()->secure('/'));
        } catch (RequestException $exception) {
            return $report->status(passed: false)
                ->message(__('SSL not configured.'))
                ->help(__('You should generate an SSL certificate. '));
        }

        return $report->status(passed: true)->message(__('Connection is secure.'));
    }
}
