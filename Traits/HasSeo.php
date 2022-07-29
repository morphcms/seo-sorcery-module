<?php

namespace Modules\SeoSorcery\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\SeoSorcery\Contracts\ICanBeSeoAnalyzed;
use Modules\SeoSorcery\Models\SeoEntity;

/**
 * @mixin Model
 */
trait HasSeo
{
    private array $seoAttributesMap = [
        'title' => 'title',
        'slug' => 'slug',
        'description' => 'summary',
        'type' => null,
    ];

    protected static function bootHasSeo(): void
    {
        static::created(function (ICanBeSeoAnalyzed $model) {
            $model->seo()->create([
                'title' => $model->getSeoAttributeValue('title'),
                'slug' => $model->getSeoAttributeValue('slug'),
                'description' => $model->getSeoAttributeValue('description'),
                'type' => $model->getSeoAttributeValue('type'),
            ]);
        });


        static::deleting(function (ICanBeSeoAnalyzed $model) {
            $model->seo()->delete();
        });
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoEntity::class, 'seoable');
    }


    /**
     * @throws \Exception
     */
    public function getSeoAttributeValue($field)
    {
        return $this->getAttribute($this->getSeoAttributeName($field));
    }

    public function getSeoAttributeName($field)
    {
        if (!array_key_exists($field, $this->seoAttributesMap)) {
            throw new \Exception("The seo '{$field}' attribute does not exist.");
        }

        return $this->seoAttributesMap[$field];
    }

    private function serializeCustomAttributes(): ?array
    {
        $customAttributes = $this->mapSeoCustomAttributes();

        if (empty($customAttributes)) {
            return null;
        }

        return collect($customAttributes)
            ->mapWithKeys(
                fn($attributeName) => [$attributeName => $this->getAttribute($attributeName)]
            )
            ->toArray();
    }

    public function mapSeoCustomAttributes(): array
    {
        return [];
    }

    protected function setSeoField($field, $value): static
    {
        $this->seoAttributesMap[$field] = $value;

        return $this;
    }
}
