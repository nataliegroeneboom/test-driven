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
    public function it_should_display_budgets_for_the_current_month()
    {
        $category = $this->create('App\Category');
        $budgetForThisMonth = $this->create('App\Budget', ['category_id', $category]);
        $budgetForLastMonth = $this->create('App\Budget', ['budget_date' => Carbon::now()->subMonth(), 'category_id' => $category]);

        $this->get('/budgets')
        ->assertSee((string) $budgetForThisMonth->amount)
        ->assertSee((string) $budgetForThisMonth->balance())
        ->assertSee((string) $budgetForLastMonth->amount)
        ->assertSee((string) $budgetForLastMonth->balance());
    }

    /**
     * @test
     */
    public function it_allows_only_authenticated_users_when_visit_budget()
    {
        $this->signOut()
        ->withExceptionHandling()
        ->get('/budgets')
        ->assertRedirect('/login');
    }
}
