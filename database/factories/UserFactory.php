<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Forum\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'confirmed' => false
    ];
});

$factory->define(\Forum\Thread::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('Forum\User')->create()->id;
        },
        'channel_id' => function() {
            return factory('Forum\Channel')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'visits' => 0
    ];
});

$factory->define(\Forum\Reply::class, function (Faker $faker) {
    return [
        'thread_id' => function () {
            return factory('Forum\Thread')->create()->id;
        },
        'user_id' => function () {
            return factory('Forum\User')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});

$factory->define(\Forum\Channel::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'slug' => $name
    ];
});

$factory->define(\Illuminate\Notifications\DatabaseNotification::class, function (Faker $faker) {
    return [
        'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
        'type' => 'Forum\Notifications\ThreadWasUpdated',
        'notification_id' => function() {
            return auth()->id() ? : factory('Forum\User')->create()->id;
        },
        'notification_type' => 'Forum\User',
        'data' => ['foo' => 'bar']
    ];
});



