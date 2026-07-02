<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::all()->pluck('value', 'key');
                
                // Share specific settings with all views
                \Illuminate\Support\Facades\View::share('site_name', $settings->get('site_name', 'Fun Smart Foundation'));
                \Illuminate\Support\Facades\View::share('site_logo', $settings->get('site_logo', ''));
                \Illuminate\Support\Facades\View::share('theme_color', $settings->get('theme_color', '#e05e36'));
                
                // Override mail configuration
                if ($settings->get('mail_host')) {
                    config([
                        'mail.default' => 'smtp',
                        'mail.mailers.smtp.host' => $settings->get('mail_host'),
                        'mail.mailers.smtp.port' => $settings->get('mail_port'),
                        'mail.mailers.smtp.username' => $settings->get('mail_username'),
                        'mail.mailers.smtp.password' => $settings->get('mail_password'),
                        'mail.mailers.smtp.encryption' => $settings->get('mail_encryption'),
                        'mail.from.address' => $settings->get('mail_from_address'),
                        'mail.from.name' => $settings->get('site_name', 'Fun Smart Foundation'),
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Ignore if database is not ready
        }
    }
}
