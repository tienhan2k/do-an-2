<?php

namespace App\Http\Controllers\Frontend;


use App\Models\Sale;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\ProductSize;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '0')->get();
        $sliders = Slider::where('status', '0')->get();
        $sale_products = Product::where('sale_price', '>', 0)->get();
        $sale_time = Sale::where('status', '0')->first();
        $latest_products = Product::where('status', '0')->latest()->get();

        return view('frontend.index', compact('categories', 'sliders',  'latest_products', 'sale_products', 'sale_time'));
    }


    public function products(Request $request, $category_slug = null, $sub_cate_slug = null)
    {
        if (isset($category_slug) and empty($sub_cate_slug)) {
            $category = Category::where('slug', $category_slug)->first();
            $categories = Category::where('status', 0)->get();
            $colors = Color::where('status', 0)->get();
            $brands = Brand::where('status', 0)->get();
            $wishlist = Wishlist::get();
            $sizes = Size::where('status', '0')->get();
            if ($category) {
                if ($request->get('sort') == 'name_a_z') {
                    $products = $category->products()->where('status', '0')
                        ->orderBy('name', 'asc')
                        ->paginate(9);
                } elseif ($request->get('sort') == 'name_z_a') {
                    $products = $category->products()->where('status', '0')
                        ->orderBy('name', 'desc')
                        ->paginate(9);
                } elseif ($request->get('sort') == 'product_lastest') {
                    $products = $category->products()->where('status', '0')
                        ->orderBy('created_at', 'desc')
                        ->paginate(9);
                } elseif ($request->get('sort') == 'price_low_high') {
                    $products = $category->products()->where('status', '0')
                        ->orderBy('original_price', 'asc')
                        ->paginate(9);
                } elseif ($request->get('sort') == 'price_high_low') {
                    $products = $category->products()->where('status', '0')
                        ->orderBy('original_price', 'desc')
                        ->paginate(9);
                } elseif ($request->get('brand')) {
                    $checked = $_GET['brand'];
                    $products = $category->products()->where('status', '0')
                        ->whereIn('brand', $checked)
                        ->paginate(9);
                } elseif ($request->get('color')) {
                    $checked = $_GET['color'];
                    $product_colors_id = ProductColor::where(function ($q) use ($checked) {
                        foreach ($checked as $value) {
                            $q->orWhere('color_id', $value);
                        }
                    })
                        ->pluck('product_id')
                        ->toArray();

                    $products = $category->products()->whereIn('id', $product_colors_id)
                        ->where('status', '0')
                        ->paginate(9);
                } elseif ($request->get('size')) {
                    $checked = $_GET['size'];
                    $product_sizes_id = ProductSize::where(function ($q) use ($checked) {
                        foreach ($checked as $value) {
                            $q->orWhere('size_id', $value);
                        }
                    })
                        ->pluck('product_id')
                        ->toArray();

                    $products = $category->products()
                        ->whereIn('id', $product_sizes_id)
                        ->where('status', '0')
                        ->paginate(9);
                } else {
                    $products = $category->products()->where('status', '0')->paginate(9);
                }
                return view('frontend.collection.products.index', compact('products', 'brands', 'sizes', 'category', 'categories', 'wishlist', 'colors'));
            } else {
                return redirect()->back();
            }
        } elseif (isset($category_slug) and isset($sub_cate_slug)) {
            $categories = Category::where('status', 0)->get();
            $category = Category::where('slug', $category_slug)->first();
            $sub_cate = $category->subCategories()->where('slug', $sub_cate_slug)->first();
            $colors = Color::where('status', 0)->get();
            $brands = Brand::where('status', 0)->get();
            $wishlist = Wishlist::get();
            $sizes = Size::where('status', '0')->get();
            if ($sub_cate) {
                if ($request->get('sort') == 'name_a_z') {
                    $products = $sub_cate->products()->where('status', '0')
                        ->orderBy('name', 'asc')
                        ->paginate(9);
                } elseif ($request->get('sort') == 'name_z_a') {
                    $products = $sub_cate->products()->where('status', '0')
                        ->orderBy('name', 'desc')
                        ->paginate(9);
                } elseif ($request->get('sort') == 'product_lastest') {
                    $products = $sub_cate->products()->where('status', '0')
                        ->orderBy('created_at', 'desc')
                        ->paginate(9);
                } elseif ($request->get('sort') == 'price_low_high') {
                    $products = $sub_cate->products()->where('status', '0')
                        ->orderBy('original_price', 'asc')
                        ->paginate(9);
                } elseif ($request->get('sort') == 'price_high_low') {
                    $products = $sub_cate->products()->where('status', '0')
                        ->orderBy('original_price', 'desc')
                        ->paginate(9);
                } elseif ($request->get('brand')) {
                    $checked = $_GET['brand'];
                    $products = $sub_cate->products()->where('status', '0')
                        ->whereIn('brand', $checked)
                        ->paginate(9);
                } elseif ($request->get('color')) {
                    $checked = $_GET['color'];
                    $product_colors_id = ProductColor::where(function ($q) use ($checked) {
                        foreach ($checked as $value) {
                            $q->orWhere('color_id', $value);
                        }
                    })
                        ->pluck('product_id')
                        ->toArray();
                    $products = $sub_cate->products()->whereIn('id', $product_colors_id)
                        ->where('status', '0')
                        ->paginate(9);
                } elseif ($request->get('size')) {
                    $checked = $_GET['size'];
                    $product_sizes_id = ProductSize::where(function ($q) use ($checked) {
                        foreach ($checked as $value) {
                            $q->orWhere('size_id', $value);
                        }
                    })
                        ->pluck('product_id')
                        ->toArray();
                    $products = $sub_cate->products()
                        ->whereIn('id', $product_sizes_id)
                        ->where('status', '0')
                        ->paginate(9);
                } else {
                    $products = $sub_cate->products()->where('status', '0')->paginate(9);
                }
                return view('frontend.collection.products.index', compact('products', 'brands', 'sizes', 'categories', 'category', 'sub_cate', 'wishlist', 'colors'));
            } else {
                return redirect()->back();
            }
        } else {
            $categories = Category::where('status', '0')->get();
            $products = Product::where('status', '0')->paginate(9);
            $wishlist = Wishlist::get();
            $colors = Color::where('status', '0')->get();
            $brands = Brand::where('status', '0')->get();
            $sizes = Size::where('status', '0')->get();
            if ($request->get('sort') == 'name_a_z') {
                $products = Product::where('status', '0')
                    ->orderBy('name', 'asc')
                    ->paginate(9);
            } elseif ($request->get('sort') == 'name_z_a') {
                $products = Product::where('status', '0')
                    ->orderBy('name', 'desc')
                    ->paginate(9);
            } elseif ($request->get('sort') == 'product_lastest') {
                $products = Product::where('status', '0')
                    ->orderBy('created_at', 'desc')
                    ->paginate(9);
            } elseif ($request->get('sort') == 'price_low_high') {
                $products = Product::where('status', '0')
                    ->orderBy('original_price', 'asc')
                    ->paginate(9);
            } elseif ($request->get('sort') == 'price_high_low') {
                $products = Product::where('status', '0')
                    ->orderBy('original_price', 'desc')
                    ->paginate(9);
            } elseif ($request->get('brand')) {
                $checked = $_GET['brand'];
                $products = Product::where('status', '0')
                    ->whereIn('brand', $checked)
                    ->paginate(9);
            } elseif ($request->get('color')) {
                $checked = $_GET['color'];
                $product_colors_id = ProductColor::where(function ($q) use ($checked) {
                    foreach ($checked as $value) {
                        $q->orWhere('color_id', $value);
                    }
                })
                    ->pluck('product_id')
                    ->toArray();

                $products = Product::whereIn('id', $product_colors_id)
                    ->where('status', '0')
                    ->paginate(9);
            } elseif ($request->get('size')) {
                $checked = $_GET['size'];
                $product_sizes_id = ProductSize::where(function ($q) use ($checked) {
                    foreach ($checked as $value) {
                        $q->orWhere('size_id', $value);
                    }
                })
                    ->pluck('product_id')
                    ->toArray();

                $products = Product::whereIn('id', $product_sizes_id)
                    ->where('status', '0')
                    ->paginate(9);
            } else {
                $products = Product::where('status', '0')->paginate(9);
            }
            return view('frontend.collection.products.index', compact('products', 'sizes', 'brands', 'categories', 'wishlist', 'colors'));
        }
    }

    public function productDetails($category_slug, $sub_cate_slug, $product_slug)
    {
        $cate = Category::where('slug', $category_slug)->first();
        $product_details = Product::where('slug', $product_slug)->first();
        $reviews = Review::where('product_id', $product_details->id)->get();
        $sub_cate = $cate->subCategories()->where('slug', $sub_cate_slug)->first();
        $r_products = $sub_cate->products()->where('status', 0)->get();
        $sale_time = Sale::find(1);
        $review_count_star = $reviews->avg('rating');
        if ($product_details) {
            $getIdColorsProduct = $product_details->productColor()->pluck('color_id')->toArray();
            $colorPro = Color::whereIn('id', $getIdColorsProduct)->get();
            $getIdSizesProduct = $product_details->productSizes()->pluck('size_id')->toArray();
            $sizePro = Size::whereIn('id', $getIdSizesProduct)->get();
            return view('frontend.collection.products.product', compact('product_details', 'colorPro', 'sizePro', 'r_products', 'reviews', 'sale_time', 'review_count_star'));
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
