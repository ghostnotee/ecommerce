<?php

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        Schema::disableForeignKeyConstraints();

        User::truncate();
        UserDetail::truncate();

        $userAdmin = User::create([
            'first_name' => 'Mahmut',
            'last_name' => 'Tuncer',
            'email' => 'mahmut@tuncer.com',
            'user_name' => 'halayceken',
            'password' => bcrypt('123456'),
            'is_active' => 1,
            'is_admin' => 1
        ]);

        $userAdmin->userDetail()->create([
            'address' => 'Papua Yeni Gine',
            'phone' => '0532 532 32 32',
            'other_phone' => '0532 532 12 12'
        ]);

        for ($i = 0; $i < 50; $i++) {
            $user = User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'user_name' => $faker->userName,
                'password' => bcrypt('123456'),
                'is_active' => 1,
                'is_admin' => 0
            ]);
            $user->userDetail()->create([
                'address' => $faker->address,
                'phone' => $faker->e164PhoneNumber,
                'other_phone' => $faker->e164PhoneNumber
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
