<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteCategoriesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_can_delete_categories()
    {
        $category = $this->create('App\Category');
        $this->delete("/categories/{$category->slug}")
        ->assertRedirect('/categories');
        $this->get('/categories')
        ->assertDontSee($category->name);
    }
 
}
