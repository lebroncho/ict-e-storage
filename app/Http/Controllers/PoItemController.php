<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PoItem;

class PoItemController extends Controller
{
    public function store(Request $request)
    {      
        PoItem::insert([
            'po_id' => $request->input('id'),
            'qty' => $request->input('qty'),
            'unit' => $request->input('unit'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'amount' => $request->input('price')*$request->input('qty')
        ]);

        return redirect()->route('purchase_order.show', $request->input('id'))->with('success', 'An item was added.');
    }

    public function update(Request $request, $id)
    {
        $item = PoItem::find($request->input('id'));

        $item->update([
            'qty' => $request->input('qty'),
            'unit' => $request->input('unit'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'amount' => $request->input('price')*$request->input('qty')
        ]);

        return redirect()->route('purchase_order.show', $item->po_id)->with('success', 'An item was updated.');
    }

    public function destroy($id)
    {
        $item = PoItem::find($id);
        $item->delete();

        return redirect()->route('purchase_order.show', $item->po_id)->with('success', 'An item was deleted.');
    }
}
