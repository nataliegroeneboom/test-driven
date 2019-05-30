<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Budget;
use App\Category;
use App\Transaction;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Transaction::class, function (Faker $faker) {
    return [
      'description' => $faker->sentence(2),
      'amount'=>$faker->numberBetween(5, 10),
      'category_id' => function() {
          return create(App\Category::class)->id;
      },
      'user_id' => function(){
        return create(App\User::class)->id;
      }
    ];
});

$factory->define(App\Category::class, function (Faker $faker) {
  $name = $faker->word;
  
  return [
    'name' => $name,
    'slug' => str_slug($name),
    'user_id' => function(){
      return create(App\User::class)->id;
    }
  ];
});

$factory->define(App\Budget::class, function (Faker $faker){
  return [
    'category_id' =>  function() {
      return create(App\Category::class)->id;
      },
      'user_id' => function(){
        return create(App\User::class)->id;
      },
      'amount' => $faker->randomFloat(2, 500, 1000),
      'budget_date' => \Carbon\Carbon::now()->format('M')
      ];
});

