<?php

namespace Modules\Shop\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Shop\Entities\Category;

class SeedCategoriesTableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $categories = [
            'Clothing', 'Food', 'Shopping', 'Electronics', 'Sports', 'Literature',
            'AutoMobile', 'Cosmetics', 'Fashion'
        ];
        foreach ($categories as $category) {
            Category::create([
                'category' => $category
            ]);
        }


        // $this->call("OthersTableSeeder");
    }
}
