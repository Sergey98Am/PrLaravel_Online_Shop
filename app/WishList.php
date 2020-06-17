<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $fillable = ['user_id','web_id','title','image','old_price','price','pro_id','category_id','brand_id','color_id','year_id'];

    public function year(){
        return $this->belongsTo('App\Year');
    }
}
