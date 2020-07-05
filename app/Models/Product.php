<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany('App/Models/Category', 'categories_products');
    }
}
