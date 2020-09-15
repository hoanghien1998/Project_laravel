<?php

use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarTrim;
use App\Models\User;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/**
 * Fake models factory.
 *
 * @var Factory $factory
 */
$factory->define(User::class, function (Generator $faker) {
    $gender = ['Male', 'Female'];

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => password_hash('123456', PASSWORD_DEFAULT),
        'gender' => $gender[rand(0, 1)],
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});

$factory->define(CarMake::class, function (Generator $faker) {
    return [
        CarMake::NAME => $faker->name,
    ];
});

$factory->define(CarModel::class, function (Generator $faker) {
    $year = intval($faker->year);
    return [
        CarModel::NAME => $faker->name,
        CarModel::YEAR_START => $year,
        CarModel::YEAR_END => $year + random_int(1, 10),
    ];
});

$factory->define(CarTrim::class, function (Generator $faker) {
    return [
        CarTrim::NAME => $faker->name,
    ];
});
