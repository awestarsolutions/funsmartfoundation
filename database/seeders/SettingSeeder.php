<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'Fun Smart Foundation', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => '', 'type' => 'image', 'group' => 'general'],
            ['key' => 'theme_color', 'value' => '#e05e36', 'type' => 'color', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'info@funsmart.org', 'type' => 'text', 'group' => 'general'],
            ['key' => 'contact_phone', 'value' => '+1234567890', 'type' => 'text', 'group' => 'general'],
            ['key' => 'contact_address', 'value' => '123 Foundation St, City', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'facebook_url', 'value' => '#', 'type' => 'text', 'group' => 'general'],
            ['key' => 'twitter_url', 'value' => '#', 'type' => 'text', 'group' => 'general'],
            ['key' => 'linkedin_url', 'value' => '#', 'type' => 'text', 'group' => 'general'],
            
            // Email Settings
            ['key' => 'mail_host', 'value' => 'smtp.mailtrap.io', 'type' => 'text', 'group' => 'email'],
            ['key' => 'mail_port', 'value' => '2525', 'type' => 'text', 'group' => 'email'],
            ['key' => 'mail_username', 'value' => '', 'type' => 'text', 'group' => 'email'],
            ['key' => 'mail_password', 'value' => '', 'type' => 'password', 'group' => 'email'],
            ['key' => 'mail_encryption', 'value' => 'tls', 'type' => 'text', 'group' => 'email'],
            ['key' => 'mail_from_address', 'value' => 'info@funsmart.org', 'type' => 'text', 'group' => 'email'],
            
            // Homepage Settings
            ['key' => 'home_hero_title', 'value' => 'Creating Meaningful Social Impact', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'home_hero_subtitle', 'value' => 'Fun Smart Foundation partners with organizations to design, execute, and measure Corporate Social Responsibility initiatives that create sustainable change across communities.', 'type' => 'textarea', 'group' => 'homepage'],
            ['key' => 'home_hero_image', 'value' => '', 'type' => 'image', 'group' => 'homepage'],
            ['key' => 'home_trust_logo_1', 'value' => '', 'type' => 'image', 'group' => 'homepage'],
            ['key' => 'home_trust_logo_2', 'value' => '', 'type' => 'image', 'group' => 'homepage'],
            ['key' => 'home_trust_logo_3', 'value' => '', 'type' => 'image', 'group' => 'homepage'],
            ['key' => 'home_trust_logo_4', 'value' => '', 'type' => 'image', 'group' => 'homepage'],
            ['key' => 'home_cta_title', 'value' => 'Let\'s Build Meaningful Impact Together.', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'home_cta_subtitle', 'value' => 'Partner with Fun Smart Foundation to build stronger communities through responsible, transparent, and measurable CSR programs.', 'type' => 'textarea', 'group' => 'homepage'],
            ['key' => 'home_about_title', 'value' => 'Building Communities. Delivering Lasting Impact.', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'home_about_text', 'value' => 'Fun Smart Foundation is a not-for-profit organization committed to developing resilient communities through carefully planned social development initiatives. We collaborate with corporations, institutions, and local communities to implement impactful CSR programs.', 'type' => 'textarea', 'group' => 'homepage'],
            
            // About Settings
            ['key' => 'about_mission', 'value' => 'Our mission is to support communities through sustainable social development.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_vision', 'value' => 'A world where corporate responsibility thrives and creates equitable growth.', 'type' => 'textarea', 'group' => 'about'],
            
            // Impact Settings
            ['key' => 'impact_title', 'value' => 'Measuring Our Reach', 'type' => 'text', 'group' => 'impact'],
            ['key' => 'impact_subtitle', 'value' => 'Data-driven impact reporting.', 'type' => 'textarea', 'group' => 'impact'],
            
            // Footer Settings
            ['key' => 'footer_text', 'value' => '© 2026 Fun Smart Foundation. All rights reserved.', 'type' => 'text', 'group' => 'footer'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
