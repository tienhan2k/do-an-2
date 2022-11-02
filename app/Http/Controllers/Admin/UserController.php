<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserFormRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::paginate(5),
        ]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserFormRequest $request)
    {
        $request->validated();
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->phone),
            'role' => $request->role,
        ]);
        return redirect(route('user.index'))->withSuccessMessage('User created.');
    }

    public function show($id)
    {
        return view('admin.user.view', [
            'user' => User::findOrFail($id),
        ]);
    }

    public function edit($id)
    {
        return view('admin.user.edit', [
            'user' => User::findOrFail($id),
        ]);
    }

    public function update(UserFormRequest $request, $id)
    {
        $request->validated();
        User::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->phone),
            'role' => $request->role,
        ]);
        return redirect(route('user.index'))->withSuccessMessage('User updated.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect(route('user.index'))->withSuccessMessage('User deleted.');

    }
}
