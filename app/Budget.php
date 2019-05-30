<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    public $fillable = ['category_id', 'amount', 'budget_date'];
    
    public static function boot()
    {
        parent::boot(); 
        static::addGlobalScope('user', function($query){  
           $query->where('user_id', auth()->id())->with('category.transactions'); 
        });
        
        static::saving(function($budget){
            $budget->user_id = $budget->user_id ?:auth()->id(); 
            $budget->budget_date = Carbon::parse($budget->budget_date)->toDateTimeString();
        });
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function balance(){
        return $this->amount - $this->category->transactions->sum('amount');
    }

    public function scopeByMonth($query, $month = 'this month')
    {
        $query->where('budget_date', '>=', Carbon::parse("first day of {$month}"))
        ->where('budget_date', '<=', Carbon::parse("last day of {$month}"));
    }

    public function getMonth(){
        return isset($this->budget_date) ? Carbon::parse($this->budget_date)->format('M') : null;
    }
}
