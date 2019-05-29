<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCategoriesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_can_create_categories()
    {
        $category = $this->make('App\Category');
        $this->post('/categories', $category->toArray())
        ->assertRedirect('/categories');

        $this->get('/categories')
        ->assertSee($category->name);
        
    }

      /**
     * @test
     */
    public function it_cannot_create_categories_without_a_name()
    {
        $this->postCategory(['name' => null])
        ->assertSessionHasErrors('name');
    }

    public function postCategory($overrides = [])
    {
        $category = make('App\Category', $overrides);
      return $this->withExceptionHandling()->post('/categories', $category->toArray());
    }

}
