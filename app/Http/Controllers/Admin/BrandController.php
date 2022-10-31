<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
use App\Models\SubCategory;

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
        return view('admin.brand.create');
    }


    public function store(BrandFormRequest $request)
    {
        $request->validated();

        Brand::create([
            'name' => $request->name,
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect(route('brand.index'))->with('message', 'Add successful.');
    }

    public function edit($id)
    {

        return view('admin.brand.edit', [
            'brand' => Brand::findOrFail($id),

        ]);
    }


    public function update(BrandFormRequest $request, $id)
    {
        $request->validated();

        Brand::findOrFail($id)->update([
            'name' => $request->name,
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect(route('brand.index'))->with('message', 'Update successful.');
    }


    public function destroy($id)
    {
        $brand = Brand::findOrFail($id)->first();
        $brand->delete();
        return redirect(route('brand.index'))->with('message', 'Delete successful.');
    }
}
