<?php

namespace App\Http\Controllers\Frontend;

use DB;
use App\Models\Sale;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class FrontendController extends Controller
{
    public function index()
    {

        $category = SubCategory::where('status', '0')
            ->inRandomOrder()
            ->firstOrFail();
        $sliders = Slider::where('status', '0')->get();
        $products = Product::where('status', '0')
            ->inRandomOrder()
            ->limit(8)
            ->get();
        $sale_products = Product::where('sale_price', '>', 0)
            ->inRandomOrder()
            ->get();
        $sale_time = Sale::first();
        $latest_products = $category->products()->latest()->get();
        $categories = SubCategory::where('status', '0')->get();

        return view('frontend.index', compact('sliders',  'products', 'latest_products', 'category', 'categories', 'sale_products', 'sale_time'));
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
            'categories' => SubCategory::where('status', '0')->get(),
        ]);
    }

    public function products(Request $request, $category_slug)
    {
        $category = SubCategory::where('slug', $category_slug)->first();
        $cate_filters = SubCategory::where('status', '0')->get();
        $brands_filters = Brand::where('status', '0')->get();
        $wishlist = Wishlist::get();
        $colors = Color::where('status', 0)->get();

        if ($category) {
            if ($request->get('sort') == 'name_a_z') {
                $products = $category->products()->where('status', '0')->orderBy('name', 'asc')->paginate(9);
            } elseif ($request->get('sort') == 'name_z_a') {
                $products = $category->products()->where('status', '0')->orderBy('name', 'desc')->paginate(9);
            } elseif ($request->get('sort') == 'product_lastest') {
                $products = $category->products()->where('status', '0')->orderBy('created_at', 'desc')->paginate(9);
            } elseif ($request->get('sort') == 'price_low_high') {
                $products = $category->products()->where('status', '0')->orderBy('original_price', 'asc')->paginate(9);
            } elseif ($request->get('sort') == 'price_high_low') {
                $products = $category->products()->where('status', '0')->orderBy('original_price', 'desc')->paginate(9);
            } elseif ($request->get('brand')) {
                $checked = $_GET['brand'];
                $products = $category->products()->where('status', '0')->whereIn('brand', $checked)->paginate(9);
            } elseif ($request->get('color')) {
                $checked = $_GET['color'];
                $product_colors = ProductColor::where(function ($q) use ($checked) {
                    foreach ($checked as $value) {
                        $q->orWhere('color_id', $value);
                    }
                })
                    ->pluck('product_id')
                    ->toArray();
                $products = $category->products()
                    ->where('status', '0')
                    ->where(function ($q) use ($product_colors) {
                        foreach ($product_colors as $value) {
                            $q->orWhere('id', $value);
                        }
                    })
                    ->paginate(9);
            } else {
                $products = $category->products()->where('status', '0')->paginate(9);
            }
            return view('frontend.collection.products.index', compact('products', 'category', 'brands_filters', 'cate_filters', 'wishlist', 'colors'));
        } else {
            return redirect()->back();
        }
    }

    public function productDetails($category_slug, $product_slug)
    {
        $category = SubCategory::where('slug', $category_slug)->first();
        $product_details = Product::where('slug', $product_slug)->first();
        $reviews = Review::where('product_id', $product_details->id)->get();
        $products = $category->products()->get();
        $sale_time = Sale::find(1);
        $review_count_star = $reviews->avg('rating');
        if ($product_details) {
            return view('frontend.collection.products.product', compact('product_details', 'products', 'category', 'reviews', 'sale_time', 'review_count_star'));
        } else {
            return redirect()->back();
        }
    }


    public function getProductListAjax()
    {
        $products = Product::select('name')->where('status', '0')->get();
        $data = [];

        foreach ($products as $value) {
            $data[] = $value['name'];
        }

        return $data;
    }


    public function searchProduct(Request $request)
    {
        if ($request->search != "") {
            $product = Product::where("name", "LIKE", "%$request->search%")->first();
            if ($product) {
                return redirect('/collections/' . $product->category->slug . '/' . $product->slug);
            } else {
                return redirect()->back()->with('error', 'No products found with your search :D');
            }
        } else {
            return redirect()->back();
        }
    }
}
