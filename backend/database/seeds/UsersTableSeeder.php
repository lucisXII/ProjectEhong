<?php


use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Teerayut Khunsuk',
	        'email' => 'teerayut@gmail.com',
	        'username' => 'teerayut',
	        'status' => '1',
	        'position' => 'Member',
            'address' => 'Kalasin',
            'phone' => '0921526980',
	        'password' => Hash::make('123456') // password
        ]);
    }
}
