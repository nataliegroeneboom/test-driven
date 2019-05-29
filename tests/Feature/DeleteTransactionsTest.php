<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Transaction;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTransactionsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_can_delete_transactions()
    {
        $transaction = $this->create('App\Transaction');
        $this->delete("/transactions/{$transaction->id}")
        ->assertRedirect('/transactions');
        $this->get('/transactions')
        ->assertDontSee($transaction->description);
    }
 
}
