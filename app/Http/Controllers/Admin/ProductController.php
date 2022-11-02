<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

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
            'categories' => Category::where('status', '0')->get(),
            'brands' => Brand::where('status', '0')->get(),
            'colors' => Color::where('status', '0')->get(),
            'sizes' => Size::where('status', '0')->get(),
        ]);
    }

    public function store(ProductFormRequest $request)
    {
        // dd($request);
        $request->validated();

        $product = Product::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'brand' => $request->brand,
            'small_description' => $request->small_description,
            'description' => $request->description,
            'original_price' => $request->original_price,
            'sale_price' => $request->sale_price != null ? $request->sale_price : '0',
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

        if ($request->sizes) {
            foreach ($request->sizes as $key => $size) {
                $product->productSizes()->create([
                    'product_id' => $product->id,
                    'size_id' => $size,
                    'quantity' => $request->size_quantity[$key] ?? 0,
                ]);
            }
        }

        return redirect(route('product.index'))->withSuccessMessage('Add successful.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('status', 0)->get();
        $brands = Brand::where('status', 0)->get();

        $product_color = $product->productColor
            ->pluck('color_id')
            ->toArray();
        $colors = Color::whereNotIn('id', $product_color)->get();

        $product_size = $product->productSizes()
            ->pluck('size_id')
            ->toArray();
        $sizes = Size::whereNotIn('id', $product_size)->get();

        return view('admin.product.edit', compact(
            'product',
            'categories',
            'brands',
            'colors',
            'sizes'
        ));
    }


    public function update(ProductFormRequest $request, $id)
    {
        // dd($request);
        $request->validated();

        $product = Product::findOrFail($id);
        $product->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'brand' => $request->brand,
            'small_description' => $request->small_description,
            'description' => $request->description,
            'original_price' => $request->original_price,
            'sale_price' => $request->sale_price != null ? $request->sale_price : '0',
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

        if ($request->sizes) {
            foreach ($request->sizes as $key => $size) {
                $product->productSizes()->create([
                    'product_id' => $product->id,
                    'size_id' => $size,
                    'quantity' => $request->size_quantity[$key] ?? 1,
                ]);
            }
        }

        return redirect(route('product.index'))->withSuccessMessage('Update successful.');
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
        return redirect()->back()->withSuccessMessage('Deleted product.');
    }

    public function destroyProductImages($id)
    {

        $productImg = ProductImage::find($id);
        $productImg_path = public_path('uploads/products/') . $productImg->image;

        if (File::exists($productImg_path)) {
            File::delete($productImg_path);
        }
        $productImg->delete();

        return redirect()->back()->withSuccessMessage('Deleted!');
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

        return response()->json(['message' => 'Deleted!']);
    }

    public function updateProductSizeQty(Request $request, $prod_size_id)
    {

        $productSizeData = Product::findOrFail($request->product_id)
            ->productSizes()
            ->where('id', $prod_size_id)
            ->first();

        $productSizeData->update([
            'quantity' => $request->qty
        ]);
        return response()->json(['message' => 'Product sizes quantity updated!']);
    }

    public function deleteProductSizeQty($prod_size_id)
    {

        $prodSize = ProductSize::findOrFail($prod_size_id);
        $prodSize->delete();

        return response()->json(['message' => 'Deleted!']);
    }


    public function fetchSubCate(Request $request)
    {
        $p_cate = Category::where('id', $request->category_id)->first();
        $sub_cate = $p_cate->subCategories()->where('status', 0)->get();

        if (count($sub_cate) > 0) {
            return response()->json($sub_cate);
        }
    }
}
