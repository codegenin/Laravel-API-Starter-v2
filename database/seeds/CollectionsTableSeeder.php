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
                
                $faker = \Faker\Factory::create();
                
                $collection->translateOrNew('en')->title       = $faker->word;
                $collection->translateOrNew('fr')->title       = $faker->word;
                $collection->translateOrNew('en')->description = $faker->paragraph;
                $collection->translateOrNew('fr')->description = $faker->paragraph;
                $collection->save();
                
                // Create sample cover
                $collection->addMediaFromUrl('https://s3.amazonaws.com/yyg-test-collections/sample.jpg')
                           ->toMediaCollection('collection');
                
                // Create sample images
                for ($i = 1; $i <= 3; $i++) {
                    $media              = $collection->addMediaFromUrl('https://s3.amazonaws.com/yyg-test-collections/sample.jpg')
                                                     ->toMediaCollection($collection->slug);
                    $media->category_id = $collection->category_id;
                    $media->user_id     = 1;
                    $media->title       = 'Sample' . $i;
                    $media->description = 'Sample' . $i;
                    $media->location    = 'Sample' . $i;
                    $media->score       = rand(0, 50000);
                    $media->save();
                }
            });
        
    }
}
