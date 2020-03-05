<?php

namespace RaggiTech\Laravel\Settings;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/database/migrations/settings.stub' => database_path(
                sprintf('migrations/%s_create_settings_table.php', date('Y_m_d_His'))
            ),
        ], 'laravel-settings');
    }

    public function register()
    {
        
    }
}
