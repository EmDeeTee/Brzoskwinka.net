<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Storage;

class ProductsController extends Controller {
    public function index() {
        return Inertia::render('Products/Add');
    }

    // TODO: Images should probably be scaled down before being stored on the server
    public function create() {
        $data = request()->validate([
            "name" => "required",
            "description" => "required",
            "price" => "required|min:1|numeric|sometimes",
            "imgSrc" => "required",
            "units" => "required|min:1|numeric|sometimes",
            "category" => "required"
        ]);

        $file = request()->file('imgSrc');

        $p = Product::create(array_merge($data, [
            "user_id" => request()->user()->id
        ]));

        $fileExt = substr($file->getClientOriginalName(), -3);
        $fileName = $p->id.'.'.$fileExt;
        Storage::putFileAs('images', request()->file('imgSrc'), $fileName);
        $p->imgSrc = asset('images/'.$fileName);
        $p->save();

        return Redirect::to('/products/'.$p->id);
    }

    public function display() {
        $p = Product::firstWhere('id', request()->id);
        return Inertia::render('Products/Display', [
            'product' => $p,
            'seller' => $p->user()->get(['id', 'name'])->first()
        ]);
    }

    // not this kind of store
    public function store() {
        return Inertia::render('Products/Products', [
            'products' => Product::all(),
        ]);
    }
}
