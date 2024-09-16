<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settings = Cache::remember('settings', 60 * 60, function () {

            if (Storage::disk('local')->exists('settings.json')) {
                $settings = Storage::disk('local')->get('settings.json');
                Storage::disk('local')->delete('settings.json');
                return json_decode($settings);
            } else {
                return Setting::all();
            }
        });

        foreach ($settings as $setting) {
            config()->set('settings.' . $setting->key, $setting->value);
        }
    }

}
