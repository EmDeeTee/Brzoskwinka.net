<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
            "user_id" => request()->user()->id,
            // FIXME: Quick hack to get this shaite to work
            "category_id" => 0
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

    public function renderProducts($products = [], $lastQuery = '', $errorMsg = null, $category = null) {
        return Inertia::render('Products/Products', [
            'products' => $products,
            'totalProductsCount' => Product::count(),
            'lastSearchQuery' => $lastQuery,
            'errorMsg' => $errorMsg,
            'category' => $category,
            'allCategories' => Category::all()->pluck('name'),
        ]);
    }

    // not this kind of store
    public function store() {
        return $this->renderProducts(Product::all());
    }

    public function search() {
        $query = request()->params;
        if (str_starts_with($query, '!user=')) {
            $userName = substr($query, strlen('!user='));
            $user = User::firstWhere(['name' => $userName]);

            if (!$user) {
                return $this->renderProducts(errorMsg: 'There are no products that match the search criteria');
            }

            $userId = $user->id;
            $res = Product::where(['user_id' => $userId])->get();

            return $this->renderProducts($res, $query, count($res) ? null : 'There are no products that match the search criteria');
        }

        $res = Product::where('name', 'LIKE', '%'.$query.'%')->get();

        return $this->renderProducts($res, $query, count($res) ? null : 'There are no products that match the search criteria');
    }
}
