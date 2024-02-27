<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller {
    public function add() {
        $r_user_id = request()->user()->id;
        $r_cart_id = request()->cart_id;
        $r_cart_user_id = request()->cart_user_id;
        $r_product_id = request()->product_id;

        // Owns the cart
        if ($r_cart_user_id == $r_user_id) {
            if (in_array($r_product_id, Cart::find($r_cart_id)->get()[0]->product_ids)) {
                return response(status: 418);
            }
            $cart = Cart::find($r_cart_id);
            $cart->update(['product_ids' => array_merge($cart->product_ids, [$r_product_id])]);

            return response(status: 200);
        } else {
            return response(status: 403);
        }
    }

    public function index() {
        $ids = request()->user()->cart()->first()->product_ids;
        $products = [];
        foreach ($ids as &$id) {
            array_push($products, Product::where(['id' => $id])->first());
        }
        return Inertia::render("Cart", [
            "products" => $products
        ]);
    }

    public function delete() {
        $r_user_id = request()->user()->id;
        $r_cart_user_id = request()->cart_user_id;
        $r_product_id = request()->product_id;
        
        // Owns the cart
        if ($r_cart_user_id == $r_user_id) {
            $cart = Cart::find(request()->user()->cart->id);
            $pids = $cart->product_ids;
            if (($key = array_search($r_product_id, $pids)) !== false) {
                unset($pids[$key]);
            }
            $cart->update(['product_ids' => $pids]); 
            return response(status: 200);
        } else {
            return response(status: 403);
        }
    }
}
