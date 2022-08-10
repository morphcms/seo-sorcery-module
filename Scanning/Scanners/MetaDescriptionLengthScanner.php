<?php

namespace Modules\SeoSorcery\Scanning\Scanners;

class MetaDescriptionLengthScanner extends LengthAwareScanner
{
        protected string $fieldName = 'description';
        protected ?int $maxLength = 160;
}
