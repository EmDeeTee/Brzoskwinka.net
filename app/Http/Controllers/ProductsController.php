<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class ProductsController extends Controller {
    public function index() {
        return Inertia::render('Products/Add');
    }

    public function create() {
        $data = request()->validate([
            "name" => "required",
            "price" => "required",
            "imageSrc" => "required",
            'canLogin' => Route::has('login')
        ]);
        
        Product::create($data);
    }

    public function display() {
        return Inertia::render('Products/Display', [
            'product' => Product::firstWhere('id', request()->id),
            'canLogin' => Route::has('login'),
        ]);
    }

    // not this kind of store
    public function store() {
        return Inertia::render('Products/Products', [
            'products' => Product::all(),
            'canLogin' => Route::has('login'),
        ]);
    }
}
