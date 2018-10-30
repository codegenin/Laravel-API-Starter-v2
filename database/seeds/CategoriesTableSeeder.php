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
        $categories = [
            [
                'name'           => 'Art Object',
                'fr_name'        => 'Objet d’Art',
                'slug'           => 'art-object',
                'description'    => 'Art Object',
                'fr_description' => 'Objet d’Art',
                'is_public'      => 1,
                'seq'            => 1,
            ],
            [
                'name'           => 'Graphic Art',
                'fr_name'        => 'Graphique Art',
                'slug'           => 'graphique-art',
                'description'    => 'Graphic Art',
                'fr_description' => 'Graphique Art',
                'is_public'      => 1,
                'seq'            => 1,
            ],
            [
                'name'           => 'Clothing',
                'fr_name'        => 'Habillement',
                'slug'           => 'habillement',
                'description'    => 'Clothing',
                'fr_description' => 'Habillement',
                'is_public'      => 1,
                'seq'            => 3
            ],
            [
                'name'        => 'Painting',
                'fr_name'     => 'Peinture',
                'slug'        => 'Peinture',
                'description' => 'Painting',
                'fr_description' => 'Paienture',
                'is_public'   => 1,
                'seq'         => 2,
            ],
            [
                'name'        => 'Photography',
                'fr_name'        => 'Photograhie',
                'slug'        => 'photographie',
                'description' => 'Photographie',
                'fr_description' => 'Photography',
                'is_public'   => 1,
                'seq'         => 4,
            ],
            [
                'name'        => 'Sculpture',
                'fr_name'        => 'Sculpture',
                'slug'        => 'sculpture',
                'description' => 'Sculpture',
                'fr_description' => 'Sculpture',
                'is_public'   => 1,
                'seq'         => 5
            ]
        ];
        
        foreach ($categories as $item) {
            $category                                    = new \App\Models\Category();
            $category->translateOrNew('en')->name        = $item['name'];
            $category->translateOrNew('fr')->name        = $item['fr_name'];
            $category->translateOrNew('en')->description = $item['description'];
            $category->translateOrNew('fr')->description = $item['fr_description'];
            $category->slug                              = str_slug($item['name']);
            $category->is_public                         = $item['is_public'];
            $category->seq                               = $item['seq'];
            $category->save();
            
            // Create sample cover
            $category->addMediaFromUrl('https://s3.eu-west-2.amazonaws.com/yoyogi-test-collections/sample.jpg')
                     ->toMediaCollection('category');
        }
    }
}
