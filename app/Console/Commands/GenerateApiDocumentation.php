<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateApiDocumentation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apidoc:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate api documentation';

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
        exec('apidoc -i app/Api/V1 -o public/docs/');
    }
}
