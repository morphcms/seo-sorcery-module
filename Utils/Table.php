<?php

namespace Modules\SeoSorcery\Utils;

use Modules\Morphling\Traits\TableHelper;

/**
 * @method static entities(string $column = null)
 */
class Table
{
    use TableHelper;

    protected static $configPath = 'seo-sorcery.table_prefix';
}
