<?php

namespace Modules\SeoSorcery\Contracts;

interface ICanScan
{
    public function scan(ICanBeSeoAnalyzed $entity): IScanResult;
}
