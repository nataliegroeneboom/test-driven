<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Transaction;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewTransactionsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_can_display_all_transactions()
    {
        $transaction = $this->create('App\Transaction');
        $this->get('/transactions')
        ->assertSee($transaction->description)
        ->assertSee($transaction->category->name);
    }

    /**
     * @test
     */
    public function it_can_filter_transactions_by_category()
    {
        $category = create('App\Category');
        $transaction = $this->create('App\Transaction', ['category_id' => $category->id]);
        $otherTransaction = $this->create('App\Transaction');

        $this->get('/transactions/' . $category->slug)
        ->assertSee($transaction->description)
        ->assertDontSee($otherTransaction->description);
    }

    /**
     * @test
     */
    public function it_allows_only_authenticated_users()
    {
        $this->signOut()
        ->withExceptionHandling()
        ->get('/transactions')
        ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function it_only_displays_transactions_that_belong_to_the_currently_logged_in_user()
    {
        $otherUser = create('App\User');
        
       $transaction = create('App\Transaction',['user_id' => $this->user->id]);
   
        $otherTransaction = create('App\Transaction', ['user_id' => $otherUser->id]);

        $this->get('/transactions')
        ->assertSee($transaction->description)
        ->assertDontSee($otherTransaction->description);   
    }

    /**
     * @test
     */
    public function it_can_filter_transactions_by_month()
    {
        $currentTransaction = $this->create('App\Transaction');
        $pastTransaction = $this->create('App\Transaction', ['created_at' => Carbon::now()->subMonth(2)]);

        $this->get('/transactions?month=' . Carbon::now()->subMonth(2)->format('M'))
        ->assertSee($pastTransaction->description)
        ->assertDontSee($currentTransaction->description);
    }
    /**
     * @test
     */
    public function it_can_filter_transactions_by_current_month_by_default()
    {
        $currentTransaction = $this->create('App\Transaction');
        $pastTransaction = $this->create('App\Transaction', ['created_at' => Carbon::now()->subMonth(2)]);

        $this->get('/transactions')
        ->assertSee($currentTransaction->description)
        ->assertDontSee($pastTransaction->description);

    }


}
