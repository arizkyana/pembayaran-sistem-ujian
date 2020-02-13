<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    private $faker;

    public function __construct(Faker\Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        // admin
        factory(User::class, 1)->create();

        // data siswa
        \Illuminate\Support\Facades\DB::table('users')
            ->insert([
                [
                    'name' => $this->faker->name,
                    'email' => 'siswa1@mail.id',
                    'email_verified_at' => now(),
                    'password' => \Illuminate\Support\Facades\Hash::make('12341234'),
                    'permissions' => implode(",", ['list-pembayaran-item', 'checkout', 'profile']),
                    'remember_token' => \Illuminate\Support\Str::random(10)
                ],
                [
                    'name' => $this->faker->name,
                    'email' => 'siswa2@mail.id',
                    'email_verified_at' => now(),
                    'password' => \Illuminate\Support\Facades\Hash::make('12341234'),
                    'permissions' => implode(",", ['list-pembayaran-item', 'checkout', 'profile']),
                    'remember_token' => \Illuminate\Support\Str::random(10)
                ],
                [
                    'name' => $this->faker->name,
                    'email' => 'siswa3@mail.id',
                    'email_verified_at' => now(),
                    'password' => \Illuminate\Support\Facades\Hash::make('12341234'),
                    'permissions' => implode(",", ['list-pembayaran-item', 'checkout', 'profile']),
                    'remember_token' => \Illuminate\Support\Str::random(10)
                ]
            ]);
    }
}
