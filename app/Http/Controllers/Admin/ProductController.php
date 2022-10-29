<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;
use App\Models\Color;

class ProductController extends Controller
{

    public function index()
    {
        return view('admin.product.index', [
            'products' => Product::orderBy('id')->paginate(5)
        ]);
    }


    public function create()
    {
        return view('admin.product.create', [
            'categories' => Category::get(),
            'products' => Product::get(),
            'brands' => Brand::get(),
            'colors' => Color::where('status', '0')->get(),
        ]);
    }

    public function store(ProductFormRequest $request)
    {
        $request->validated();
        $category = Category::findOrFail($request->category_id);

        $product = $category->products()->create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'brand' => $request->brand,
            'small_description' => $request->small_description,
            'description' => $request->description,
            'original_price' => $request->original_price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'trending' => $request->trending == true ? '1' : '0',
            'featured' => $request->featured == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'meta_title' => $request->meta_title,
        ]);
        $i = 1;
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $imgFile) {

                $ext = $imgFile->getClientOriginalExtension();
                $fileName =  time() . $i++ . '.' . $ext;

                $imgFile->move('uploads/products/', $fileName);

                $product->productImages()->create([
                    'image' => $fileName,
                    'product_id' => $product->id
                ]);
            }
        }

        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->productColor()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->color_quantity[$key] ?? 0,
                ]);
            }
        }

        return redirect(route('product.index'))->with('message', 'Add successful.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::get();
        $brands = Brand::get();

        $product_color = $product->productColor
                        ->pluck('color_id')
                        ->toArray();
        $colors = Color::whereNotIn('id', $product_color)->get();

        return view('admin.product.edit', compact(
            'product',
            'categories',
            'brands',
            'colors'
        ));
    }


    public function update(ProductFormRequest $request, $id)
    {
        // dd($request);
        $request->validated();
        $product = Category::findOrFail($request->category_id)
                            ->products()
                            ->where('id', $id)
                            ->first();

        if ($product) {
            $product->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'brand' => $request->brand,
                'small_description' => $request->small_description,
                'description' => $request->description,
                'original_price' => $request->original_price,
                'sale_price' => $request->sale_price,
                'quantity' => $request->quantity,
                'trending' => $request->trending == true ? '1' : '0',
                'featured' => $request->featured == true ? '1' : '0',
                'status' => $request->status == true ? '1' : '0',
                'meta_description' => $request->meta_description,
                'meta_keyword' => $request->meta_keyword,
                'meta_title' => $request->meta_title,
            ]);

            $i = 1;

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $imgFile) {

                    $ext = $imgFile->getClientOriginalExtension();
                    $fileName =  time() . $i++ . '.' . $ext;

                    $imgFile->move('uploads/products/', $fileName);

                    $product->productImages()->create([
                        'image' => $fileName,
                        'product_id' => $product->id
                    ]);
                }
            }

            if ($request->colors) {
                foreach ($request->colors as $key => $color) {
                    $product->productColor()->create([
                        'product_id' => $product->id,
                        'color_id' => $color,
                        'quantity' => $request->color_quantity[$key] ?? 1,
                    ]);
                }
            }

            return redirect(route('product.index'))->with('message', 'Update successful.');
        } else {
            return redirect(route('product.index'))->with('message', 'Product not found.');
        }
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->productImages) {
            foreach ($product->productImages as $image) {
                $productImg_path = public_path('uploads/products') . '/' . $image->image;
                // dd($productImg_path);
                if (File::exists($productImg_path)) {
                    File::delete($productImg_path);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message', 'Deleted product.');
    }

    public function destroyProductImages($id)
    {

        $productImg = ProductImage::find($id);
        $productImg_path = public_path('uploads/products/') . $productImg->image;

        if (File::exists($productImg_path)) {
            File::delete($productImg_path);
        }
        $productImg->delete();

        return redirect()->back()->with('message', 'Deleted!');
    }

    public function updateProductColorQty(Request $request, $prod_color_id)
    {

        $productColorData = Product::findOrFail($request->product_id)
                                    ->productColor()
                                    ->where('id', $prod_color_id)
                                    ->first();

        $productColorData->update([
            'quantity' => $request->qty
        ]);
        return response()->json(['message' => 'Product colors quantity updated!']);

    }

    public function deleteProductColorQty($prod_color_id)
    {

        $prodColor = ProductColor::findOrFail($prod_color_id);
        $prodColor->delete();

        return response()->json(['message'=>'Deleted!']);

    }
}
