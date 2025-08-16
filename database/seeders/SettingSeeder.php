<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'logo',
                'value' => 'images/logo.png',
                'type' => 'image'
            ],
            [
                'key' => 'site_name',
                'value' => 'MPOELOT',
                'type' => 'text'
            ],
            [
                'key' => 'site_description',
                'value' => 'Situs Game Online Terpercaya',
                'type' => 'text'
            ]
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type']
                ]
            );
        }
    }
}
