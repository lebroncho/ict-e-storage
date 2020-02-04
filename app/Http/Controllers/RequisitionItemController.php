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

    public function update(Request $request, $id)
    {
        $item = RequisitionItem::find($id);
    }

    public function destroy($id)
    {
        $item = RequisitionItem::find($id);
        $item->delete();

        return redirect()->route('requisition_item.edit', $item->requisition_id)->with('success', 'An item was deleted.');
    }
}
