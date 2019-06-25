<?php

namespace Pxpm\ForecastIO\Database\Seeders;

use Illuminate\Database\Seeder;

use Pxpm\Starter\Models\SystemSettings;
use Illuminate\Support\Facades\Cache;


class ForecastSettingSeeder extends Seeder
{
    protected $settings = [
        ['label' => 'forecast_api_key','namespace' => 'system.forecast', 'type' => 'text'],
        ['label' => 'forecast_options','namespace' => 'system.forecast', 'type' => 'text'],
        ['label' => 'forecast_latitude','namespace' => 'system.forecast', 'type' => 'text'],
        ['label' => 'forecast_longitude','namespace' => 'system.forecast', 'type' => 'text'],

    ];

    public function run()
    {
        !isset($this->settings) ?: SystemSettings::createSettings($this->settings,'starter');

        Cache::forget('system.settings');
    }

}