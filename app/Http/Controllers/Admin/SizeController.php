<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{

    public function index()
    {
        return view('admin.size.index', [
            'sizes' => Size::orderBy('id')->paginate(5)
        ]);
    }


    public function create()
    {
        return view('admin.size.create');
    }


    public function store(Request $request)
    {
        Size::create([
            'name' => $request->name,
            'status' => $request->status == true ? '1' : '0',
        ]);
        return redirect()->route('size.index')->withSuccessMessage('Add successfully!');
    }

    public function edit($id)
    {
        return view('admin.size.edit', [
            'size' => Size::findOrFail($id)
        ]);
    }


    public function update(Request $request, $id)
    {
        Size::findOrFail($id)->update([
            'name' => $request->name,
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect(route('size.index'))->withSuccessMessage('Update successfully.');
    }


    public function destroy($id)
    {
        $size = Size::findOrFail($id)->first();
        $size->delete();
        return redirect(route('size.index'))->withSuccessMessage('Delete successfully.');
    }
}
