<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewBudgetsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_display_budgets_for_the_current_month_by_default()
    {
        
        $category = $this->create('App\Category');
        $budgetForThisMonth = $this->create('App\Budget', ['category_id' => $category->id]);
        $budgetForLastMonth = $this->create('App\Budget', ['budget_date' => Carbon::now()->subMonth(), 'category_id' => $category->id]);
        $this->get('/budgets')
        ->assertSee((string) $budgetForThisMonth->amount)
        ->assertSee((string) $budgetForThisMonth->balance())
        ->assertDontSee((string)$budgetForLastMonth->amount)
        ->assertDontSee((string) $budgetForLastMonth->balance());
    }

     /**
     * @test
     */
    public function it_allows_only_authenticated_users_visit_budget_page()
    {
        $this->signOut()
        ->withExceptionHandling()
        ->get('/budgets')
        ->assertRedirect('/login');
    }


      /**
     * @test
     */
    public function it_only_displays_budgets_that_belong_to_the_currently_logged_in_user()
    {
        $category = $this->create('App\Category');
        $otherUser = create('App\User');
        $budget = $this->create('App\Budget', ['category_id' => $category->id ]);
        $otherBudget = $this->create('App\Budget', ['category_id' => $category->id, 'user_id' => $otherUser->id]);

        $this->get('/budgets')
        ->assertSee((string) $budget->amount)
        ->assertDontSee((string) $otherBudget->amount);   
    }

   
}
