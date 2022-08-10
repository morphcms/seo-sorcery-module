<?php

namespace Modules\SeoSorcery\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Tool;
use Modules\SeoSorcery\Nova\Resources\SeoEntity;

class SeoSorceryTool extends Tool
{
    private array $resources = [
        SeoEntity::class,
    ];


    public function boot()
    {
        \Nova::resources($this->resources);
    }

    public function menu(Request $request)
    {

        return null;

        return MenuSection::make(__('SEO'), [
            MenuItem::externalLink('Radar', '')->canSee(fn() => true),
            // MenuItem::resource(SeoEntity::class)->canSee(fn() => true),
        ])
            ->icon('presentation-chart-bar')
            ->canSee(fn() => true);
    }
}
