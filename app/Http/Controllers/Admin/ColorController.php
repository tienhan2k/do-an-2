<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{
    public function index()
    {
        return view('admin.color.index', [
            'colors' => Color::latest()->paginate(5)
        ]);
    }


    public function create()
    {
        return view('admin.color.create');
    }


    public function store(ColorFormRequest $request)
    {
        $request->validated();

        Color::create([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect(route('color.index'))->with('message', 'Thêm thành công.');
    }

    public function edit($id)
    {
        return view('admin.color.edit', [
            'color' => Color::findOrFail($id)
        ]);
    }


    public function update(ColorFormRequest $request, $id)
    {
        $request->validated();

        Color::findOrFail($id)->update([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect(route('color.index'))->with('message', 'Cập nhật thành công.');
    }


    public function destroy($id)
    {
        $color = Color::findOrFail($id)->first();
        $color->delete();
        return redirect(route('color.index'));
    }
}
