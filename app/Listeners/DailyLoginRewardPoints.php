<?php

namespace App\Listeners;

use App\Events\AuthLoginEventHandler;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DailyLoginRewardPoints
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    /**
     * Handle the event.
     *
     * @param  AuthLoginEventHandler $event
     * @return void
     */
    public function handle(AuthLoginEventHandler $event)
    {
        $setting = new Setting();
        if ($event->user->last_login != null AND $event->user->last_login <= Carbon::now()
                                                                                   ->subDay(1)
                                                                                   ->toDateTimeString()) {
            
            $reward = $setting->where('setting_name', 'daily_reward_points')
                              ->first();
            
            $event->user->points = $event->user->points + $reward->setting_value;
            $event->user->save();
        }
    }
}
