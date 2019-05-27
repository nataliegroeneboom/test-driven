<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTransactionsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function it_can_create_transactions()
    {
        $transaction = make('App\Transaction');
        $this->post('/transactions', $transaction->toArray())
        ->assertRedirect('/transactions');

        $this->get('/transactions')
        ->assertSee($transaction->description);
    }
}
