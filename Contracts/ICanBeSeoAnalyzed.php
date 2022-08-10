<?php

namespace Modules\SeoSorcery\Contracts;

use Modules\SeoSorcery\Utils\SeoOptions;

interface ICanBeSeoAnalyzed
{
    public function seo();

    public function getSeoOptions(): SeoOptions;
}
