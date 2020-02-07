<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequisitionItem;
use App\Requisition;

class RequisitionItemController extends Controller
{
    public function edit($id)
    {
        $items = RequisitionItem::where('requisition_id', $id)->get();

        return view('requisition_item.edit', ['items'=>$items, 'id'=>$id]);
    }

    public function store(Request $request)
    {
        RequisitionItem::insert([
            'requisition_id' => $request->input('r_id'),
            'qty' => $request->input('qty'),
            'unit' => $request->input('unit'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('requisition.show', $request->input('r_id'))->with('success', 'An item was added.');
    }

    public function update(Request $request, $id)
    {
        $item = RequisitionItem::find($request->input('id'));

        $item->update([
            'qty' => $request->input('qty'),
            'unit' => $request->input('unit'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('requisition.show', $item->requisition_id)->with('success', 'An item was updated.');
    }

    public function destroy($id)
    {
        $item = RequisitionItem::find($id);
        $item->delete();

        return redirect()->route('requisition.show', $item->requisition_id)->with('success', 'An item was deleted.');
    }
}
