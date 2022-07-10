<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\user;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    user::create([
        'name'=>'admin',
        'national_number'=>'12345678912345',
        'email'=>'admin@gmail.com',
        'password'=>bcrypt(123456),
        'photo'=>'default.jpg',
        'permission'=>'admin'
    ]);
    }
}
