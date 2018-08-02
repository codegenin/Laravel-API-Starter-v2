<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new \App\Models\Setting();
        
        $settings = [
            [
                'setting_name' => 'daily_reward_points',
                'setting_value' => 50
            ]
        ];
        
        foreach($settings as $setting) {
            $model->create($setting);
        }
    }
}
