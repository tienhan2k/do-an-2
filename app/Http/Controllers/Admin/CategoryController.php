<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function index()
    {
        Session::put('current_url', request()->fullUrl());
        return view('admin.category.index', [
            'categories' => Category::orderBy('id')->paginate(5)
        ]);
    }

    public function create()
    {
        return view('admin.category.create', [
            'categories' => Category::where('status', '0')->get(),
        ]);
    }

    public function store(CategoryFormRequest $request)
    {
        $request->validated();

        if ($request->parent_category_id) {
            SubCategory::create([
                'category_id' => $request->parent_category_id,
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'image' => $this->storeImage($request),
                'meta_title' => $request->meta_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'status' => $request->status == true ? '1' : '0',
            ]);
        } else {
            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'image' => $this->storeImage($request),
                'meta_title' => $request->meta_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'status' => $request->status == true ? '1' : '0',
            ]);
        }

        return redirect(route('category.index'))->withSuccessMessage('Add successful.');
    }

    public function storeImage($request)
    {
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $fileName = time() . '.' . $ext;

        $file->move('uploads/categories/', $fileName);
        return $fileName;
    }

    public function edit($id, $s_id = null)
    {
        if ($s_id != null) {
            return view('admin.category.edit-sub-cate', [
                's_cate' => SubCategory::findOrFail($s_id),
                'p_cate' => Category::where('status', '0')->get(),
            ]);
        } else {
            return view('admin.category.edit-parent-cate', [
                'category' => Category::findOrFail($id),
                'all_cate' => Category::where('status', '0')->get(),
            ]);
        }
    }

    public function update(Request $request, $id, $s_id = null)
    {
        if ($request->s_id) {
            SubCategory::findOrFail($s_id)->update([
                'category_id' => $request->parent_category_id,
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'image' => $this->updateSubCateImage($request, $request->s_id),
                'meta_title' => $request->meta_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'status' => $request->status == true ? '1' : '0',
            ]);
        } else {
            Category::findOrFail($id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'image' => $this->updateImage($request, $request->id),
                'meta_title' => $request->meta_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'status' => $request->status == true ? '1' : '0',
            ]);
        }

        if (session('current_url')) {
            return redirect(session('current_url'))->withSuccessMessage('Update successful!');
        } else {
            return redirect(route('category.index'))->withSuccessMessage('Update successful.');
        }
    }

    public function updateSubCateImage($request, $s_id)
    {
        $category = SubCategory::find($s_id);
        if ($request->hasFile('image')) {
            $image_path = public_path('uploads/categories/') . $category->image;
            if (File::exists($image_path)) {
                File::delete($image_path);

                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $ext;
                $file->move('uploads/categories/', $fileName);

                return $fileName;
            }
        } else {
            $fileName = $category->image;
            return $fileName;
        }
    }

    public function updateImage($request, $id)
    {
        $category = Category::find($id);
        if ($request->hasFile('image')) {
            $image_path = public_path('uploads/categories/') . $category->image;
            if (File::exists($image_path)) {
                File::delete($image_path);

                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $ext;
                $file->move('uploads/categories/', $fileName);

                return $fileName;
            }
        } else {
            $fileName = $category->image;
            return $fileName;
        }
    }

    public function destroy($id, $s_id = null)
    {
        if ($s_id != null) {
            if ($category = SubCategory::findOrFail($s_id)) {

                $destination = public_path('uploads/categories/') . $category->image;

                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $category->delete();
                return redirect(route('category.index'))->withSuccessMessage('Delete successful.');
            } else {
                return redirect(route('category.index'))->withErrorMessage('Delete failure.');
            }
        } else {
            if ($category = Category::findOrFail($id)) {

                $destination = public_path('uploads/categories/') . $category->image;

                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $category->delete();
                return redirect(route('category.index'))->withSuccessMessage('Delete successful.');
            } else {
                return redirect(route('category.index'))->withErrorMessage('Delete failure.');
            }
        }


    }
}
