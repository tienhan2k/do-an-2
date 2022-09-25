<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{

    public function index()
    {
        return view('admin.category.index', [
            'categories' => Category::orderBy('id')->paginate(5)
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $request->validated();

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
            'image' => $this->storeImage($request),
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect(route('category.index'))->with('message', 'Thêm thành công.');
    }

    public function storeImage($request)
    {
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $fileName = time(). '.' . $ext;

        $file->move('uploads/categories/', $fileName);
        return $fileName;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('admin.category.edit', [
            'category' => Category::findOrFail($id)
        ]);
    }

    public function update(CategoryFormRequest $request, $id)
    {
        $request->validated();

        $data = Category::findOrFail($id);

        $data->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
            'image' => $this->updateImage($request, $request->id),
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect(route('category.index'))->with('message', 'Cập nhật thành công.');
    }

    public function updateImage( $request, $id )
    {
        $category = Category::find($id);

        if ($request->hasFile('image')) {
            $image_path = public_path('uploads/categories/').$category->image;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time(). '.' . $ext;
            $file->move('uploads/categories/', $fileName);

            return $fileName;
        }
    }

    public function destroy($id)
    {
        if ($category = Category::findOrFail($id)) {

            $destination = public_path('uploads/categories/'). $category->image;

            if(File::exists($destination)){
                File::delete($destination);
            }
            $category->delete();
            return redirect(route('category.index'))->with('message', 'Xoá thành công');
        } else {
            return redirect(route('category.index'))->with('message', 'Xoá thất bại');
        }
    }
}
