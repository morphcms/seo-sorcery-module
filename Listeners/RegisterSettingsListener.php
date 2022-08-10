<?php

namespace Modules\SeoSorcery\Listeners;

use Modules\SeoSorcery\Settings\SeoSettings;
use Modules\Settings\Events\BootSettingsPage;

class RegisterSettingsListener
{
    public function __construct()
    {
    }

    public function handle(BootSettingsPage $event): array
    {
        return [
            new SeoSettings(),
        ];
    }
}
