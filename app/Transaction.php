<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
