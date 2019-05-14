<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Category;
use App\Transaction;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Transaction::class, function (Faker $faker) {
    return [
      'description' => $faker->sentence(2),
      'category_id' => function() {
          return factory(App\Category::class)->create()->id;
      }
    ];
});

$factory->define(App\Category::class, function (Faker $faker) {
  return [
    'name' => $faker->word
  ];
});