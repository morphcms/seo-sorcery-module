<?php

namespace Modules\SeoSorcery\Scanning\Scanners;

class MetaTitleLengthScanner extends LengthAwareScanner
{
    protected string $fieldName = 'title';
    protected ?int $maxLength = 60;

}
