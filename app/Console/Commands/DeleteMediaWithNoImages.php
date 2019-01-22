<?php

namespace App\Console\Commands;

use App\ACME\Helpers\CheckRemoteFileHelper;
use App\Models\Media;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteMediaWithNoImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:media_with_no_images';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete media record that has no images thats accessible in s3';
    
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
        Media::where('verified', 0)
            ->where('collection_name', '!=', 'category')
            ->where('collection_name', '!=', 'collection')
            ->chunk(20, function ($medias) {
                foreach ($medias as $media) {
                    $encodedName = urlencode($media->name);
                    $mediaSmallUrl    = "https://" . env('AWS_CLOUDFRONT') . "/" . $media->id .
                        "/conversions/{$encodedName}-small.jpg";
                    $medialMediumUrl = "https://" . env('AWS_CLOUDFRONT') . "/" . $media->id .
                        "/conversions/{$encodedName}-medium.jpg";
                    
                    if (CheckRemoteFileHelper::checkRemoteFile($mediaSmallUrl) AND
                        CheckRemoteFileHelper::checkRemoteFile($medialMediumUrl)) {
                        $media->verified = 1;
                        $media->save();
                        Log::debug('DELETE_MEDIA_NO_IMAGE_VERIFIED_MEDIA_ID' . json_encode($media->id));
                    } else {
                        // Remote the media file
                        $media->delete();
                        Log::debug('DELETE_MEDIA_NO_IMAGE_VERIFIED_DELETED_MEDIA_ID' . json_encode($media->id));
                    }
                }
            });
    }
}
