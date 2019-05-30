<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteBudgetsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_can_delete_budgets()
    {
        $category = $this->create('App\Category');
        $budget = $this->create('App\Budget', ['category_id' => $category->id]);
 
        $this->delete("/budgets/{$budget->id}")
            ->assertRedirect('/budgets');
 
        $this->get('/budgets')
            ->assertDontSee((string) $budget->amount);
    }
}
