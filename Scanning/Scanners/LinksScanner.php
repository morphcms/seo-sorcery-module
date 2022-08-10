<?php

namespace Modules\SeoSorcery\Scanning\Scanners;

use Modules\SeoSorcery\Contracts\ICanBeSeoAnalyzed;
use Modules\SeoSorcery\Contracts\IScanResult;
use Modules\SeoSorcery\Scanning\Scanner;
use Modules\SeoSorcery\Scanning\ScanResult;
use PHPHtmlParser\Dom;

class LinksScanner extends Scanner
{

    /**
     * @throws \Exception
     */
    public function scan(ICanBeSeoAnalyzed $entity): IScanResult
    {
        $options = $entity->getSeoOptions();

        $content = $options->getAttributeValue('content');

        // FIXME: Should find an approach compatible with Page Builder
        $dom = new Dom;
        $dom->loadStr($content);
        $report = ScanResult::make(__('Links Scanner'));

        $tags = $dom->find('a');
        $countDeadLinks = 0;
        $countInternalLinks = 0;
        $countExternalLinks = 0;

        if ($tags->count() === 0) {
            return $report->hasPassed('There are not any links within your content.');
        }

        $baseHost = parse_url(url('/'), PHP_URL_HOST);

        foreach ($tags as $tag) {
            $link = $tag->getAttribute('href');
            if (empty($link) || $link === '#') {
                $countDeadLinks++;

                continue;
            }

            if ($baseHost === parse_url($link, PHP_URL_HOST)) {
                $countInternalLinks++;

                continue;
            }

            $countExternalLinks++;
        }

        $meta = [
            'dead' => $countDeadLinks,
            'internal' => $countInternalLinks,
            'external' => $countExternalLinks,
        ];

        return $report->meta($meta)
            ->hasPassed(__('There are :internal internal links, :external external links and :dead dead links', $meta));
    }


    private function findUrls()
    {

    }
}
