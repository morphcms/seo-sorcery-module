<?php

namespace Modules\SeoSorcery\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SeoEntityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'meta' => $this->meta,
        ];
    }
}
