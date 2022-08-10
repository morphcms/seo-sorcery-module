<?php

namespace Modules\SeoSorcery\Scanning\Scanners;

use Modules\SeoSorcery\Contracts\ICanBeSeoAnalyzed;
use Modules\SeoSorcery\Contracts\IScanResult;
use Modules\SeoSorcery\Scanning\Scanner;
use Modules\SeoSorcery\Scanning\ScanResult;
use PHPHtmlParser\Dom;

class ImageAltScanner extends Scanner
{

    public function scan(ICanBeSeoAnalyzed $entity): IScanResult
    {
        $options = $entity->getSeoOptions();

        $content = $options->getAttributeValue('content');
        $report = ScanResult::make(__('Image Alt'));

        $dom = new Dom;
        $dom->loadStr($content);
        $images = $dom->find('img');

        $countEmpty = 0;

        if ($images->count() === 0) {
            return $report->hasPassed(__('There are no images.'));
        }

        foreach ($images as $image) {
            $altAttribute = $image->getAttribute('alt');

            if (empty($altAttribute)) {
                $countEmpty++;
            }
        }

        if ($countEmpty === 0) {
            $report->hasPassed(__('Great! All images have an alt text.'));
        }


        return $report->hasFailed(__('You have :count images with an empty alt attribute.', ['count' => $countEmpty]));
    }
}
