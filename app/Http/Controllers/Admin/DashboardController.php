<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function user()
    {
        return view('admin.user.index', [
            'users' => User::paginate(5),
        ]);
    }

    public function show($id)
    {
        return view('admin.user.view', [
            'user' => User::findOrFail($id),
        ]);
    }
}
