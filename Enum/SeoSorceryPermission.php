<?php

namespace Modules\SeoSorcery\Enum;

enum SeoSorceryPermission: string
{
    case All = 'seo-sorcery.*';
    case View = 'seo-sorcery.view'; // View the module menu;
    case ViewSettings = 'seo-sorcery.viewSettings';
    case ViewDashboard = 'seo-sorcery.viewDashboard';
}
