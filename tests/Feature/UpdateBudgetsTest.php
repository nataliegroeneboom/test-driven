<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateBudgetsTest extends TestCase
{
    use RefreshDatabase;
     /**
     * @test
     */
    public function it_can_update_budgets()
    {
        $category = $this->create('App\Category', ['user_id' => $this->user->id]);
        $budget = $this->create('App\Budget', ['category_id' => $category->id]);
        $newBudget = $this->make('App\Budget', ['category_id' => $category->id]);

        $this->put("/budgets/{$budget->id}", $newBudget->toArray())
        ->assertRedirect('/budgets');
        $this->get('/budgets')
        ->assertSee($newBudget->amount);
    }

      /**
     * @test
     */
    public function it_cannot_update_budget_without_date()
    {
        $this->putBudget(['budget_date'=> null])
        ->assertSessionHasErrors('budget_date');
    }

     /**
     * @test
     */
    public function it_cannot_update_budget_without_amount()
    {
        $this->putBudget(['amount'=> null])
        ->assertSessionHasErrors('amount');
    }
     /**
     * @test
     */

    public function it_cannot_update_budget_without_category()
    {
        $this->putBudget(['category_id'=> null])
        ->assertSessionHasErrors('category_id');
    }

    public function putBudget($overrides = [])
    {
        $budget = $this->create('App\Budget');
        $budgetUpdate = make('App\Budget', $overrides);
      return $this->withExceptionHandling()
      ->put("/budgets/{$budget->id}", $budgetUpdate->toArray());
    }
}
