<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id','web_id','title','image','old_price','price','total_price','quantity','category_id','brand_id','color_id','year_id'];

}
