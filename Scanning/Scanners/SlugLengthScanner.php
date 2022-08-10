<?php

namespace Modules\SeoSorcery\Scanning\Scanners;

class SlugLengthScanner extends LengthAwareScanner
{
    protected string $fieldName = 'slug';
    protected ?int $maxLength = 76;
}
