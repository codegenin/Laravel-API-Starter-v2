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
                'name'        => 'Art Graphique',
                'slug'        => 'art-graphique',
                'description' => 'Art Graphique',
                'is_public'   => 1,
                'seq'         => 1,
            ],
            [
                'name'        => 'Habillement',
                'slug'        => 'habillement',
                'description' => 'Habillement',
                'is_public'   => 1,
                'seq'         => 3
            ],
            [
                'name'        => 'Peinture',
                'slug'        => 'Peinture',
                'description' => 'Paienture',
                'is_public'   => 1,
                'seq'         => 2,
            ],
            [
                'name'        => 'Photograhie',
                'slug'        => 'photographie',
                'description' => 'Photographie',
                'is_public'   => 1,
                'seq'         => 4,
            ],
            [
                'name'        => 'Sculpture',
                'slug'        => 'sculpture',
                'description' => 'Sculpture',
                'is_public'   => 1,
                'seq'         => 5
            ]
        ];
        
        foreach ($categories as $item) {
            $media = $category->create($item);
            
            // Create sample cover
            $media->addMediaFromUrl('https://s3.amazonaws.com/yyg-test-collections/sample.jpg')
                     ->toMediaCollection('category');
        }
    }
}
