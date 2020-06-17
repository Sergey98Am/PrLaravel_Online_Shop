<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    function user(){
        return $this->belongsTo('App\User');
    }

    protected $fillable = ['user_id','billing_email','billing_name','billing_address','billing_city','billing_province','billing_postalcode','billing_phone','billing_name_on_card', 'billing_discount','billing_discount_code', 'billing_new_total_price','billing_total','payment_gateway','shipped', 'error'];

    function products(){
        return $this->hasMany('App\OrderProduct');
    }
}
