<?php

namespace App\Console\Commands;

use App\Models\View;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ClearViewsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $view = new View();
        $view->where('created_at', '<=', Carbon::now()->subHours(12))->delete();
    }
}
