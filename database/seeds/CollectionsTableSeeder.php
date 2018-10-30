<?php

use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class CollectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Collection::class, 5)
            ->create()
            ->each(function ($collection) {
                
                $fakeEn     = \Faker\Factory::create('en_EN');
                $fakeFr     = \Faker\Factory::create('fr_FR');
                $timePeriod = $fakeEn->numberBetween(1900, 1945);
                
                $collection->translateOrNew('en')->title       = $fakeEn->word;
                $collection->translateOrNew('fr')->title       = $fakeFr->word;
                $collection->translateOrNew('en')->description = $fakeEn->paragraph;
                $collection->translateOrNew('fr')->description = $fakeFr->paragraph;
                $collection->translateOrNew('en')->time_period = $timePeriod;
                $collection->translateOrNew('fr')->time_period = $timePeriod;
                $collection->save();
                
                // Create sample cover
                $collection->addMediaFromUrl('https://s3.eu-west-2.amazonaws.com/yoyogi-test-collections/sample.jpg')
                           ->toMediaCollection('collection');
                
                // Create sample images
                for ($i = 1; $i <= 3; $i++) {
                    
                    $media                                    = $collection->addMediaFromUrl('https://s3.eu-west-2.amazonaws.com/yoyogi-test-collections/sample.jpg')
                                                                           ->toMediaCollection($collection->slug);
                    $media->category_id                       = $collection->category_id;
                    $media->user_id                           = 1;
                    $media->museum                            = $fakeEn->word;
                    $media->translateOrNew('en')->title       = $fakeEn->word;
                    $media->translateOrNew('fr')->title       = $fakeFr->word;
                    $media->translateOrNew('en')->description = $fakeEn->word;
                    $media->translateOrNew('fr')->description = $fakeFr->paragraph;
                    $media->translateOrNew('en')->medium      = $fakeEn->word;
                    $media->translateOrNew('fr')->medium      = $fakeFr->word;
                    $media->translateOrNew('en')->location    = $fakeEn->country;
                    $media->translateOrNew('fr')->location    = $fakeFr->country;
                    $media->score                             = rand(0, 50000);
                    $media->save();
                }
            });
        
    }
}
