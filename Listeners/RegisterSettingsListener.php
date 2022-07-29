<?php

namespace Modules\SeoSorcery\Listeners;

use Modules\SeoSorcery\Settings\SeoSettingsPage;
use Modules\Settings\Events\BootSettingsPage;

class RegisterSettingsListener
{
    public function __construct()
    {
    }

    public function handle(BootSettingsPage $event): array
    {
        return [
            new SeoSettingsPage(),
        ];
    }
}
