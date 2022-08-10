<?php

namespace Modules\SeoSorcery\Scanning\Scanners;

use Modules\SeoSorcery\Contracts\ICanBeSeoAnalyzed;
use Modules\SeoSorcery\Contracts\IScanResult;
use Modules\SeoSorcery\Enum\SchemeType;
use Modules\SeoSorcery\Scanning\Scanner;
use Modules\SeoSorcery\Scanning\ScanResult;

class SchemaTypeScanner extends Scanner
{

    public function scan(ICanBeSeoAnalyzed $entity): IScanResult
    {
        $options = $entity->getSeoOptions();
        $schema = $options->type;
        $report = ScanResult::make('Schema', __('Scheme is set to :schema ', ['schema' => $schema->value]));

        if (empty($schema) || $schema === SchemeType::None) {
            // Fail
            return $report->failed()->put(__('Schema Type'),__('There is no schema type set.'));
        }

        return $report->passed();
    }
}
