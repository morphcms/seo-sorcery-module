<?php

namespace Modules\SeoSorcery\Enum;

use Modules\Morphling\Enums\HasValues;

enum Severity: string
{
    use HasValues;

    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case CRITICAL = 'critical';
}
