<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['id','images','title','old_price','price','availability','condition','web_id','quantity','category_id','brand_id','color_id','year_id'];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function brand(){
        return $this->belongsTo('App\Brand');
    }

    public function color(){
        return $this->belongsTo('App\Color');
    }
    public function year(){
        return $this->belongsTo('App\Year');
    }
}
