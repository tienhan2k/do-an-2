<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function index()
    {
        return view('admin.sale.index', [
            'sale' => Sale::first(),
        ]);
    }

    public function edit($id)
    {
        return view('admin.sale.edit', [
            'sale' => Sale::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        Sale::findOrFail($id)->update([
            'sale_date' => $request->sale_date,
            'status' => $request->status,
        ]);

        return redirect(route('sale.index'))->withSuccessMessage('Update successful.');
    }
}
