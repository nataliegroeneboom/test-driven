<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $fillable = ['description', 'category_id', 'amount'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeByCategory($query, Category $category){
        if($category->exists){
            $query->where('category_id', $category->id);
        }
    }
}
