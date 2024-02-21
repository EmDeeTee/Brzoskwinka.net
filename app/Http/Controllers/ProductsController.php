<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProductsController extends Controller {
    public function index() {
        return Inertia::render('Products/Add');
    }

    public function create() {
        $data = request()->validate([
            "name" => "required",
            "price" => "required",
            "imageSrc" => "required"
        ]);
        
        Product::create($data);
    }
}
