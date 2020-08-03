<?php

namespace Modules\Shop\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Shop\Entities\Shop;

class ShopDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $shops = ['Manjil', 'Evo Store', 'Bajeko Sekuwa', 'Thuldai ko dokan', 'Big Mart', 'KK Mart'];
        $motto = [
            'We offer tea', 'We fix your apple', 'we serve sekuwa', 'Evreything kirana',
            'big just like the name', 'your night time mart'
        ];
        $location = ['Ku gate', 'Durabar Marg', 'Baneshowr', 'Sombare', 'Bhaktapur', 'Satdobato'];
        $desc = 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti
         atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt 
         ';

        foreach ($shops as $index => $shop) {
            if ($index < 3) {
                $user_id = 1;
            } else {
                $user_id = 2;
            }
            Shop::create([
                'name' => $shop,
                'motto' => $motto[$index],
                'description' => $desc,
                'location' => $location[$index],
                'phone1' => 021540632,
                'phone2'=> 9832675488,
                'website' => 'mywebsite.com',
                'email' => 'contact@example.com',
                'user_id' => $user_id

            ]);
        }
    }
}
