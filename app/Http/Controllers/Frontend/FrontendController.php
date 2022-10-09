<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {

        $category = Category::where('status', '0')
                                ->inRandomOrder()
                                ->first();
        // dd($category);
        $sliders = Slider::where('status', '0')->get();
        $products = Product::where('status', '0')
                            ->inRandomOrder()
                            ->limit(8)
                            ->get();

        $latest_products = $category->products()->latest()->get();
        $categories = Category::where('status', '0')->get();

        return view('frontend.index', compact('sliders',  'products', 'latest_products', 'category', 'categories'));
    }

    public function getAllProducts()
    {
        return view('frontend.collection.products.all-products', [
            'products' => Product::where('status', '0')->paginate(9),
            'wishlist' => Wishlist::get(),
        ]);
    }

    public function categories()
    {
        return view('frontend.collection.categories.index', [
            'categories' => Category::where('status', '0')->get(),
        ]);
    }

    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        $best_sellers = Product::where('status', '0')
                            ->where('trending', '1')
                            ->get();
        $cate_filters = Category::where('status', '0')->get();
        $wishlist = Wishlist::get();

        if ($category) {
            $products = $category->products()->paginate(9);
            return view('frontend.collection.products.index', compact('products', 'category', 'best_sellers', 'cate_filters', 'wishlist'));
        } else {
            return redirect()->back();
        }

    }

    public function productDetails($category_slug, $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        $product_details = Product::where('slug', $product_slug)->first();
        $products = $category->products()->get();
        // dd($product_de);
        if ($product_details) {
            return view('frontend.collection.products.product', compact('product_details', 'products','category'));
        } else {
            return redirect()->back();
        }
    }


}
