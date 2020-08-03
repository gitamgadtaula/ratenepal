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
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        User::create([
            'name' => 'User1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('user123')
        ]);
    }
}
