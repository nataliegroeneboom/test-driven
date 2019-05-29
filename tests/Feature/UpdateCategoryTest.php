<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_can_update_category()
    {
        $category = $this->create('App\Category');
        $newCategory = $this->make('App\Category');

        $this->put("/categories/{$category->slug}", $newCategory->toArray())
        ->assertRedirect('/categories');
        $this->get('/categories')
        ->assertSee($newCategory->name);
    }


    public function putCategory($overrides = [])
    {
        $category = $this->create('App\Category');
        $categoryUpdate = make('App\Category', $overrides);
      return $this->withExceptionHandling()
      ->put("/categories/{$category->id}", $categoryUpdate->toArray());
    }
}
