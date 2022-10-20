<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{

    public function showProfile()
    {
        return view('frontend.user.profile', [
            'user' => User::findOrFail(Auth::user()->id),
        ]);
    }

    public function editProfile($id)
    {
        return view('frontend.user.edit', [
            'user' => User::findOrFail($id),
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        // dd(User::findOrFail($id));
        $user = User::findOrFail($id);     
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $this->updateImage($request, $id),
            'address' => $request-> address,
            'district' => $request-> district,
            'city' => $request-> city,
            'province' => $request-> province,
        ]);
        return redirect(route('frontend.user.profile'))->with('message', 'We just updated.');
    }

    public function updateImage($request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->hasFile('image')) {
            $image_path = public_path('uploads/profile/').$user->image;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time(). '.' . $ext;
            $file->move('uploads/profile/', $fileName);

            return $fileName;
        }
    }

    public function listOrders()
    {
        // $orders = Order::where('user_id', Auth::id())->get();
        return view('frontend.order.index', [
            'orders' => Order::where('user_id', Auth::id())->get()
        ]);
    }

    public function viewOrder($id)
    {
        $order = Order::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();
        return view('frontend.order.view', compact('order'));
    }
}
