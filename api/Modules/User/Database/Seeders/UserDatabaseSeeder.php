<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;
// use Modules\User\Entities\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        User::create([
            'username' => 'Admin',
            'full_name' => 'Rate Nepal Admin',
            'location' => 'Worldwide',
            'gender' => 'neutral',
            'occupation' => 'Software Engineer',

            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        User::create([
            'username' => 'saroj',
            'full_name' => 'saroj poudel',
            'email' => 'saroj@gmail.com',
            'location' => 'BhaisePati',
            'gender' => 'male',
            'occupation' => 'Qualitiy Analyst',
            'password' => bcrypt('saroj123')
        ]);
    }
}
