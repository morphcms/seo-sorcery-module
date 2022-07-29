<?php

namespace Modules\SeoSorcery\Contracts;

interface ICanInspect
{
    public function inspect() : IScanResult;

    public function name(): string;

    public function help(): string;
}
