<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    public function index()
    {
        Session::put('current_url', request()->fullUrl());
        return view('admin.slider.index', [
            'sliders' => Slider::orderBy('id')->paginate(5)
        ]);
    }


    public function create()
    {
        return view('admin.slider.create');
    }


    public function store(SliderFormRequest $request)
    {
        $request->validated();

        Slider::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $this->storeImage($request),
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect(route('slider.index'))->withSuccessMessage('Add successful.');
    }


    public function storeImage($request)
    {
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $fileName = time() . '.' . $ext;

        $file->move('uploads/sliders/', $fileName);
        return $fileName;
    }

    public function edit($id)
    {
        return view('admin.slider.edit', [
            'slider' => Slider::findOrFail($id)
        ]);
    }


    public function update(SliderFormRequest $request, $id)
    {
        $request->validated();

        $data = Slider::findOrFail($id);

        $data->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $this->updateImage($request, $request->id),
            'status' => $request->status == true ? '1' : '0',
        ]);

        if (session('current_url')) {
            return redirect(session('current_url'))->withSuccessMessage('Update successful!');
        } else {
            return redirect(route('slider.index'))->withSuccessMessage('Update successful.');
        }
    }


    public function updateImage($request, $id)
    {
        $slider = Slider::findOrFail($id);

        if ($request->hasFile('image')) {
            $image_path = public_path('uploads/sliders/') . $slider->image;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('uploads/sliders/', $fileName);

            return $fileName;
        } else {
            $fileName = $slider->image;
            return $fileName;
        }
    }


    public function destroy($id)
    {
        if ($slider = Slider::findOrFail($id)) {

            $destination = public_path('uploads/sliders/') . $slider->image;

            if (File::exists($destination)) {
                File::delete($destination);
            }
            $slider->delete();
            return redirect(route('slider.index'))->withSuccessMessage('Delete successful');
        } else {
            return redirect(route('slider.index'))->withErrorMessage('There is something wrong.');
        }
    }
}
