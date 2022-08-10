<?php

namespace Modules\SeoSorcery\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Morphling\Events\BootModulesNovaDashboards;
use Modules\Morphling\Events\BootModulesNovaTools;

use Modules\SeoSorcery\Listeners\RegisterNovaToolsListener;
use Modules\SeoSorcery\Listeners\RegisterSettingsListener;
use Modules\SeoSorcery\Nova\SeoSorceryTool;
use Modules\Settings\Events\BootSettingsPage;
use Nuwave\Lighthouse\Events\BuildSchemaString;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BootModulesNovaTools::class => [
            RegisterNovaToolsListener::class,
        ],

        /*BootModulesNovaDashboards::class => [

        ],*/

        BootSettingsPage::class => [
           // RegisterSettingsListener::class,
        ],

        /*BuildSchemaString::class => [

        ],*/


    ];
}
