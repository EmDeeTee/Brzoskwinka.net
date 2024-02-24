<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller {
    public function add() {
        $r_user_id = request()->user()->id;
        $r_cart_id = request()->cart_id;
        $r_cart_user_id = request()->cart_user_id;
        $r_product_id = request()->product_id;

        // Owns the cart
        if ($r_cart_user_id == $r_user_id) {
            return Cart::firstWhere(['id' => $r_cart_id])->product_ids[0] = 0;
            Cart::firstWhere(['id' => $r_cart_id])->product_ids = '[1,2,3]';
            return response();
        } else {
            return response(status: 403);
        }
    }
}
