<?php

namespace Modules\SeoSorcery\Listeners;

use Modules\Morphling\Events\BootModulesNovaTools;
use Modules\SeoSorcery\Nova\SeoSorceryTool;

class RegisterNovaToolsListener
{
    public function __construct()
    {
    }

    public function handle(BootModulesNovaTools $event)
    {
        return [
            SeoSorceryTool::make(),
        ];
    }
}
