<?php

namespace Modules\SeoSorcery\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Tool;

class SeoSorceryTool extends Tool
{
    private array $resources = [

    ];


    public function boot()
    {
        \Nova::resources($this->resources);
    }

    public function menu(Request $request)
    {
        return MenuSection::make(__('SEO'), [
            MenuItem::externalLink('Radar', '')->canSee(fn() => true),
            MenuItem::externalLink('Entities', '')->canSee(fn() => true),
        ])
            ->icon('presentation-chart-bar')
            ->canSee(fn() => true);
    }
}
