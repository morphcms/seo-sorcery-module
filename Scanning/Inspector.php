<?php

namespace Modules\SeoSorcery\Scanning;

use Modules\SeoSorcery\Contracts\ICanInspect;
use Modules\SeoSorcery\Contracts\IScanResult;

abstract class Inspector implements ICanInspect
{
    public function name(): string
    {
        return '';
    }

    public function help(): string
    {
        return '';
    }
}
