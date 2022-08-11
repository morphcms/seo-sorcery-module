<?php

namespace Modules\SeoSorcery\Traits;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\SeoSorcery\Transformers\SeoEntityResource;
use Orion\Http\Resources\Resource;

/**
 * @mixin JsonResource|Resource
 */
trait HasSeoTransformer
{
    protected function seoEntityTransformer()
    {
        return $this->whenLoaded('seo', fn() => SeoEntityResource::make($this->seo));
    }
}
