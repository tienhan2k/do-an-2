<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
use App\Models\Category;

class BrandController extends Controller
{

    public function index()
    {
        return view('admin.brand.index', [
            'brands' => Brand::orderBy('id')->paginate(5),

        ]);
    }


    public function create()
    {
        return view('admin.brand.create', [
            'categories' => Category::where('status', '0')->get(),
        ]);
    }


    public function store(BrandFormRequest $request)
    {
        $request->validated();

        Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'status' => $request->status == true ? '1' : '0',
            'category_id' => $request->category_id,
        ]);

        return redirect(route('brand.index'))->with('message', 'Thêm thành công.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        return view('admin.brand.edit', [
            'brand' => Brand::findOrFail($id),
            'category' => Category::where('status', '0')->get(),
        ]);
    }


    public function update(BrandFormRequest $request, $id)
    {
        $request->validated();

        Brand::findOrFail($id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'status' => $request->status == true ? '1' : '0',
            'category_id' => $request->category_id,
        ]);

        return redirect(route('brand.index'))->with('message', 'Cập nhật thành công.');
    }


    public function destroy($id)
    {
        $brand = Brand::findOrFail($id)->first();
        $brand->delete();
        return redirect(route('brand.index'));
    }
}
