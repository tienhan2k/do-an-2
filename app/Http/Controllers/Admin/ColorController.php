<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use Illuminate\Support\Facades\Session;

class ColorController extends Controller
{
    public function index()
    {
        Session::put('current_url', request()->fullUrl());
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

        return redirect(route('color.index'))->withSuccessMessage('Add successful.');
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

        if (session('current_url')) {
            return redirect(session('current_url'))->withSuccessMessage('Update successful!');
        } else {
            return redirect(route('color.index'))->withSuccessMessage('Update successful.');
        }
    }


    public function destroy($id)
    {
        $color = Color::findOrFail($id)->first();
        $color->delete();
        return redirect(route('color.index'));
    }
}
