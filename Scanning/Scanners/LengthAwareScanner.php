<?php

namespace Modules\SeoSorcery\Scanning\Scanners;

use Modules\SeoSorcery\Contracts\ICanBeSeoAnalyzed;
use Modules\SeoSorcery\Contracts\IScanResult;
use Modules\SeoSorcery\Scanning\Scanner;
use Modules\SeoSorcery\Scanning\ScanResult;

abstract class LengthAwareScanner extends Scanner
{
    protected string $fieldName;
    protected int $minLength = 0;
    protected ?int $maxLength = null;


    /**
     * @throws \Exception
     */
    public function scan(ICanBeSeoAnalyzed $entity): IScanResult

    {
        $result = ScanResult::make(__(':field Length', ['field' => $this->fieldName]));
        $options = $entity->getSeoOptions();

        $field = $options->getAttributeValue($this->fieldName);

        // Check if it has a seo title
        if (empty($field)) {
            // Fail
            return $result->put('Empty Field', __("Field ':field' is empty or not set.", ['field' => $this->fieldName]));
        }

        $length = strlen($field);
        $result->with('length', $length);

        // Checks for range
        if (!is_null($this->maxLength)) {
            $passed = $length >= $this->minLength && $length <= $this->maxLength;
            $message = $this->minLength >= 0 ? 'The :field should have between :min and :max characters.' : 'The :field should be no longer than :max characters.';

            $result->put(__('Length Range'), __($message, [
                'field' => $this->fieldName,
                'min' => $this->minLength,
                'max' => $this->maxLength,
            ]));

        } else {
            $passed = $length >= $this->minLength;
            $result->put(__('Minimum Length'), __('The :field should have at least :min characters.', [
                'field' => $this->fieldName,
                'min' => $this->minLength,
            ]));
        }


        return $result->status($passed);
    }

}
