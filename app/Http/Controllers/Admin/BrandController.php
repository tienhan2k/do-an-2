<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;

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

        return redirect(route('brand.index'))->withSuccessMessage('Add successful.');
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

        return redirect(route('brand.index'))->withSuccessMessage('Update successful.');
    }


    public function destroy($id)
    {
        $brand = Brand::findOrFail($id)->first();
        $brand->delete();
        return redirect(route('brand.index'))->withSuccessMessage('Delete successful.');
    }
}
