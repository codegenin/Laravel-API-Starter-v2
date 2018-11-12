<?php

namespace App\Console\Commands;

use App\Models\DownloadImage;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DownloadImagesFromS3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 's3:download.images';
    
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
        $images = new DownloadImage();
        $client = new Client();
        
        foreach ($images->where('is_done', 0)
                        ->cursor() as $image) {
            
            $subs = explode('/', $image->url);
            
            try {
                #$contents = file_get_contents($image->url);
                #$name     = substr($image->url, strrpos($image->url, '/') + 1);
                #$folder   = "{$subs['4']}/{$subs[5]}/{$name}";
                #Storage::put($folder, $contents);
                $client->request('GET', $image->url);
            } catch (\Exception $e) {
                $image->has_error     = 1;
                $image->error_message = $e;
            }
            
            $image->is_done = 1;
            $image->save();
        }
        
    }
}
