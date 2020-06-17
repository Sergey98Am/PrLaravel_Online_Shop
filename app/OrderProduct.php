<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['order_id','user_id','product_id', 'web_id', 'title', 'image', 'old_price', 'price', 'total_price', 'quantity', 'category_id', 'brand_id', 'color_id', 'year_id'];

    public function year(){
        return $this->belongsTo('App\Year');
    }

}
