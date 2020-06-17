<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;

class Coupon extends Model
{
    public static function findByCode($code){
        return self::where('code',$code)->first();
    }

    public function discount(){
        $sum = 0;
        $cart = Cart::all();
        foreach ($cart as $item){
            $sum += $item->total_price;
        }
        if ($this->type == 'fixed'){
            return $this->value;
        }else if($this->type == 'percent'){
            return round(($this->percent_off / 100) * $sum);
        }else{
            return 0;
        }
    }
}
