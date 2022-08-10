<?php

namespace Modules\SeoSorcery\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\SeoSorcery\Contracts\ICanBeSeoAnalyzed;
use Modules\SeoSorcery\Models\SeoEntity;
use Modules\SeoSorcery\Utils\SeoOptions;

/**
 * @mixin Model
 */
trait HasSeo
{
    private ?SeoOptions $seoOptions = null;

    protected static function bootHasSeo(): void
    {
        static::created(function (ICanBeSeoAnalyzed $model) {
            $options = $model->getSeoOptions();

            $model->seo()->create([
                'title' => $options->getAttributeValue('title'),
                'description' => $options->getAttributeValue('description'),
                'keywords' => $options->getAttributeValue('keywords'),
            ]);
        });

        static::deleting(function (ICanBeSeoAnalyzed $model) {
            $model->seo()->delete();
        });
    }

    public function getSeoOptions(): SeoOptions
    {
        if (!$this->seoOptions) {
            $this->seoOptions = $this->setSeoOptions();
        }

        return $this->seoOptions;
    }


    abstract protected function setSeoOptions(): SeoOptions;


    public function seo(): MorphOne
    {
        return $this->morphOne(SeoEntity::class, 'seoable');
    }
}
