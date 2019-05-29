<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Transaction;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTransactionsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_can_update_transactions()
    {
        $category = $this->create('App\Category');
        $transaction = $this->create('App\Transaction');
        $newTransaction = $this->make('App\Transaction', ['category_id' => $category->id]);

        $this->put("/transactions/{$transaction->id}", $newTransaction->toArray())
        ->assertRedirect('/transactions');
        $this->get('/transactions')
        ->assertSee($newTransaction->description);
    }

    /**
     * @test
     */
    public function it_cannot_update_transaction_without_description()
    {
        $this->putTransaction(['description'=> null])
        ->assertSessionHasErrors('description');
    }

     /**
     * @test
     */
    public function it_cannot_update_transaction_without_amount()
    {
        $this->putTransaction(['amount'=> null])
        ->assertSessionHasErrors('amount');
    }
     /**
     * @test
     */

    public function it_cannot_update_transaction_without_category()
    {
        $this->putTransaction(['category_id'=> null])
        ->assertSessionHasErrors('category_id');
    }

       /**
     * @test
     */

    public function it_cannot_update_transaction_without_valid_amount()
    {
        $this->putTransaction(['amount'=> 'hello'])
        ->assertSessionHasErrors('amount');
    }

    public function putTransaction($overrides = [])
    {
        $transaction = $this->create('App\Transaction');
        $transactionUpdate = make('App\Transaction', $overrides);
      return $this->withExceptionHandling()
      ->put("/transactions/{$transaction->id}", $transactionUpdate->toArray());
    }
    
}
