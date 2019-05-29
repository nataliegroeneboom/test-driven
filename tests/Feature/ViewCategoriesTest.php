<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewCategoriesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_can_display_all_categories()
    {
        $category = $this->create('App\Category');
        $this->get('/categories')
        ->assertSee($category->name);
    }

    /**
     * @test
     */
    public function it_can_only_display_categories_page_if_authenticated()
    {
        $this->signOut()
        ->withExceptionHandling()
        ->get('/categories')
        ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function it_only_displays_categories_that_belong_to_currently_logged_in_user()
    {
        $otherUser = create('App\User');
        $category = $this->create('App\Category');
   
        $otherCategory = $this->create('App\Category', ['user_id' => 3]);

        $this->get('/categories')
        ->assertSee($category->name)
        ->assertDontSee($otherCategory->name);  
    }
}
