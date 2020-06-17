<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = ['title'];

    function product(){
        return $this->hasMany('App\Product');
    }
}
