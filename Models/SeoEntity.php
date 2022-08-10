<?php

namespace Modules\SeoSorcery\Models;

use Artesaos\SEOTools\Contracts\SEOFriendly;
use Artesaos\SEOTools\Contracts\SEOTools;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;
use Modules\SeoSorcery\Contracts\ICanBeSeoAnalyzed;
use Modules\SeoSorcery\Enum\SchemeType;
use Modules\SeoSorcery\Utils\Table;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Translatable\HasTranslations;


class SeoEntity extends Model implements SEOFriendly
{
    use HasTranslations;

    protected $guarded = [];
    protected array $translatable = ['title', 'description', 'keywords'];

    protected $casts = [
        'meta' => 'array',
        'report' => 'json',
        'last_scan_at' => 'datetime',
    ];

    public function getTable(): string
    {
        return Table::entities();
    }

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }

    public function registerReport(Collection $results)
    {
        $this->report = $results->toJson();
        $this->last_scan_at = now();

        return $this;
    }

    public function loadSEO(SEOTools $SEOTools)
    {
        $SEOTools->setTitle($this->title);
        $SEOTools->setDescription($this->description);
        $SEOTools->metatags()->setKeywords($this->keywords);

        if ($this->relationLoaded('seoable')) {
            $seoable = $this->seoable;

            if (!($seoable instanceof ICanBeSeoAnalyzed)) {
                return;
            }

            $options = $seoable->getSeoOptions();

            if ($options->type !== SchemeType::None)
                $SEOTools->opengraph()->setType($this->type);


            if ($seoable instanceof HasMedia) {
                $thumbnail = $seoable->getMedia($options->thumbnailCollection);
                $SEOTools->addImage($thumbnail->getUrl());

                $images = $seoable->getMedia($options->imagesCollection);
                foreach ($images as $image) {
                    $SEOTools->addImage($image->getUrl());
                }
            }

            $meta = array_merge($options->meta(), $this->meta);

            foreach ($meta as $key => $value) {
                $SEOTools->opengraph()->addProperty($key, $value);
            }
        }
    }
}
