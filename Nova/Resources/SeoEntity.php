<?php

namespace Modules\SeoSorcery\Nova\Resources;

use Eminiarts\Tabs\Traits\HasTabs;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class SeoEntity extends Resource
{
    use HasTabs;

    public static string $model = \Modules\SeoSorcery\Models\SeoEntity::class;

    public static $displayInNavigation = false;

    public static $title = 'title';

    public static $search = [
        'title', 'description', 'type', 'slug', 'keywords',
    ];


    public function fields(NovaRequest $request): array
    {
        $url = 'https://www.searchenginejournal.com/important-tags-seo/156440/#close';

        return [
            Text::make(__('Title'), 'title')
                ->help(__('seo-sorcery::nova.title', compact('url')))
                ->nullable()
                ->translatable(),

            Textarea::make(__('Description'), 'description')
                ->help(__('seo-sorcery::nova.description', compact('url')))
                ->nullable()
                ->translatable(),

            Textarea::make(__("Keywords"), 'keywords')
                ->help(__('seo-sorcery::nova.keywords', compact('url')))
                ->nullable()
                ->rows(2)
                ->translatable(),

            KeyValue::make(__('OpenGraph Properties'), 'meta')
                ->help(__('seo-sorcery::nova.meta', compact('url')))
                ->nullable(),
        ];
    }
}
