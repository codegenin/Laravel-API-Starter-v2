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
    
                $fakeEn = \Faker\Factory::create('en_EN');
                $fakeFr = \Faker\Factory::create('fr_FR');
                
                $collection->translateOrNew('en')->title       = $fakeEn->word;
                $collection->translateOrNew('fr')->title       = $fakeFr->word;
                $collection->translateOrNew('en')->description = $fakeEn->paragraph;
                $collection->translateOrNew('fr')->description = $fakeFr->paragraph;
                $collection->save();
                
                // Create sample cover
                $collection->addMediaFromUrl('https://s3.amazonaws.com/yyg-test-collections/sample.jpg')
                           ->toMediaCollection('collection');
                
                // Create sample images
                for ($i = 1; $i <= 3; $i++) {
                    
                    $media                                    = $collection->addMediaFromUrl('https://s3.amazonaws.com/yyg-test-collections/sample.jpg')
                                                                           ->toMediaCollection($collection->slug);
                    $media->category_id                       = $collection->category_id;
                    $media->user_id                           = 1;
                    $media->translateOrNew('en')->title        = $fakeEn->word;
                    $media->translateOrNew('fr')->title        = $fakeFr->word;
                    $media->translateOrNew('en')->description = $fakeEn->word;
                    $media->translateOrNew('fr')->description = $fakeFr->paragraph;
                    $media->location                          = 'Sample' . $i;
                    $media->score                             = rand(0, 50000);
                    $media->save();
                }
            });
        
    }
}
