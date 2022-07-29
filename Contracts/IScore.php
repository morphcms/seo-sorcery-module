<?php

namespace Modules\SeoSorcery\Contracts;

use Modules\SeoSorcery\Enum\Severity;

interface IScore
{
    function value(): int;

    function severity(): Severity;
}
