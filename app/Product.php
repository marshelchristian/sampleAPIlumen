<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    

    public function scopeShow($query,$id)
    {
        return $query->where('id', $id);
    }
}
