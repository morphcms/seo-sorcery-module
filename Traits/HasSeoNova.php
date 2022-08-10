<?php

namespace Modules\SeoSorcery\Traits;

use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Panel;
use Modules\SeoSorcery\Nova\Resources\SeoEntity;

trait HasSeoNova
{

    public function seoField(): MorphOne
    {
        return MorphOne::make(__('SEO'), 'seo', SeoEntity::class);
    }
}
