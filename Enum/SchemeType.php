<?php

namespace Modules\SeoSorcery\Enum;

enum SchemeType: string
{
    case None = '';
    case Article = 'article';
    case Video = 'video';
    case Review = 'review';
    case Recipe = 'recipe';
    case Product = 'product';
    case People = 'people';
    case Event = 'event';
    case Business = 'business';
}
