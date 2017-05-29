 <?php

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->freeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Article::class, function (Faker\Generator $faker) {
    $tags = collect(['php', 'ruby', 'java', 'javascript', 'bash'])
        ->random(2)
        ->values()
        ->all();
    $title = $faker->sentence;

    return [
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->text,
        'tags' => implode(',', $tags),
        'niveau_id' => function () {
            return factory(\App\Niveau::class)->create()->id;
        },
        'filiere_id' => function () {
            return factory(\App\Filiere::class)->create()->id;
        }
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Auteur::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->word;

    return [
        'name' => $faker->name,
        'slug' => str_slug($name),
        'email' => $faker->freeEmail,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Niveau::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Filiere::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Categorie::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Admin::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->freeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10)
    ];
});
