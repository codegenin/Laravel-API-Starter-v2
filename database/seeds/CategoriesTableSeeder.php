<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Models\Category();
        
        $categories = [
            [
                'name'        => 'Design',
                'slug'        => 'design',
                'description' => 'buildings, building, construction, object, works',
                'is_public'   => 1,
                'seq'         => 1,
            ],
            [
                'name'        => 'Illustration',
                'slug'        => 'illustration',
                'description' => 'drawing, graphics',
                'is_public'   => 1,
                'seq'         => 3
            ],
            [
                'name'        => 'Mode',
                'slug'        => 'mode',
                'description' => 'creation, clothing, jewelry',
                'is_public'   => 1,
                'seq'         => 2,
            ],
            [
                'name'        => 'Painting',
                'slug'        => 'painting',
                'description' => 'painting, graffiti',
                'is_public'   => 1,
                'seq'         => 4,
            ],
            [
                'name'        => 'Company',
                'slug'        => 'company',
                'description' => 'people, societal power',
                'is_public'   => 1,
                'seq'         => 5
            ],
            [
                'name'        => 'Photography',
                'slug'        => 'photography',
                'description' => 'artistic photos, nature',
                'is_public'   => 1,
                'seq'         => 6
            ],
        ];
        
        foreach ($categories as $item) {
            $media = $category->create($item);
            
            // Create sample cover
            $media->addMediaFromUrl('https://s3.amazonaws.com/yyg-test-collections/sample.jpg')
                     ->toMediaCollection('category');
        }
    }
}
