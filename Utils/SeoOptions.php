<?php

namespace Modules\SeoSorcery\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Modules\SeoSorcery\Enum\SchemeType;
use Modules\SeoSorcery\Nova\Resources\SeoEntity;

/**
 *
 */
class SeoOptions
{
    private Model $model;
    public array $meta = [];

    public string $imagesCollection = 'default';
    public string $thumbnailCollection = 'thumbnail';
    public SchemeType $type = SchemeType::None;

    public array $attributesMap = [
        'title' => 'title',
        'description' => 'summary',
        'slug' => 'slug',
        'keywords' => 'tags',
        'content' => null,
    ];

    public function __construct($model, array $attributesMap = [])
    {
        $this->model = $model;
        $this->setAttributesMap($attributesMap);
    }

    public static function make(...$args): static
    {
        return new static(...$args);
    }

    public function setAttributesMap(array $attributesMap): static
    {
        $this->attributesMap = array_merge($this->attributesMap, $attributesMap);

        return $this;
    }

    public function setType(SchemeType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function setImagesCollection(string $field): static
    {
        $this->imagesCollection = $field;

        return $this;
    }

    public function setThumbnailCollection(string $field): static
    {
        $this->thumbnailCollection = $field;

        return $this;
    }

    public function setMeta(array $meta): static
    {
        $this->meta = $meta;

        return $this;
    }

    public function addMeta(string $key, mixed $value): static
    {
        $this->meta[$key] = $value;

        return $this;
    }

    public function meta(): array
    {
        return $this->meta;
    }

    /**
     * @throws \Exception
     */
    public function getAttributeValue(string $field)
    {
        return $this->model->getAttribute($this->getAttributeName($field));
    }

    /**
     * @throws \Exception
     */
    public function getAttributeName($field)
    {
        if (!array_key_exists($field, $this->attributesMap)) {
            throw new \Exception("The seo '{$field}' attribute does not exist.");
        }

        return $this->attributesMap[$field];
    }

}
