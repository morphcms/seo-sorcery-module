<?php

namespace Modules\SeoSorcery\Scanning\Scanners;

use Modules\SeoSorcery\Contracts\ICanBeSeoAnalyzed;
use Modules\SeoSorcery\Contracts\IScanResult;
use Modules\SeoSorcery\Scanning\Radar;
use Modules\SeoSorcery\Scanning\ScanResult;

abstract class LengthAwareScanner extends Radar
{

    public function __construct(
        private readonly string $fieldName,
        private readonly int    $minLength = 0,
        private readonly ?int   $maxLength = null
    )
    {
    }

    public function scan(ICanBeSeoAnalyzed $entity): IScanResult

    {
        $result = ScanResult::make(__(':field Length', ['field' => $this->fieldName]));

        $field = $entity->getSeoAttributeValue($this->fieldName);

        // Check if it has a seo title
        if (empty($field)) {
            // Fail
            return $result->message("Field '{$field}' is not set.");
        }

        $length = strlen($field);

        // Checks for range
        if (!is_null($this->maxLength)) {
            $passed = $length >= $this->minLength && $length <= $this->maxLength;

            $result->message(__('The :field should have between :min and :max characters.', [
                'field' => $field,
                'min' => $this->minLength,
                'max' => $this->maxLength,
            ]));
        } else {
            $passed = $length >= $this->minLength;
            $result->message(__('The :field should have at least :min characters.', [
                'field' => $field,
                'min' => $this->minLength,
            ]));
        }


        return $result->status($passed);
    }

}
