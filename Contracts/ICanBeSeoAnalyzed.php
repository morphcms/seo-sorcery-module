<?php

namespace Modules\SeoSorcery\Contracts;

interface ICanBeSeoAnalyzed
{
    public function seo();

    public function getSeoAttributeName($field);

    public function getSeoAttributeValue($field);
}
