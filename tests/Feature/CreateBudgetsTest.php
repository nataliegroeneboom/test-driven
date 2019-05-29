<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateBudgetsTest extends TestCase
{
    use RefreshDatabase;

    
       /**
     * A basic feature test example.
     *
     * @test
     */
    public function it_can_create_budgets()
    {
        $category = $this->create('App\Category');
        $budget = $this->make('App\Transaction', ['category_id' => $category->id]);
        $this->post('/budgets', $budget->toArray())
        ->assertRedirect('/budgets');

        $this->get('/budgets')
        ->assertSee((string) $budget->amount);
    }

}
