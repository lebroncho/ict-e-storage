<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Po;
use App\PoItem;

class PoController extends Controller
{
    public function index()
    {
        $purchase_orders = Po::all();
        return view('po.index', ['purchase_orders'=>$purchase_orders]);
    }

    public function create()
    {
        return view('po.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/', $name);  
                $data[] = $name;  
            }
            $po = Po::create([
                'po_num' => $request->input('po_num'),
                'po' => $request->input('po'),
                'issuance_num' => $request->input('issuance_num'),
                'po_date' => $request->input('po_date'),
                'released_by' => $request->input('released_by'),
                'supplier' => $request->input('supplier'),
                'received_by' => $request->input('received_by'),
                'endorsed_to' => $request->input('endorsed_to'),
                'filename' => json_encode($data)
            ]);    
            
            for($i = 0; $i < sizeof($request->qty); $i++)
            {
                PoItem::insert([
                    'po_id' => $po->id,
                    'qty' => $request->qty[$i],
                    'unit' => $request->unit[$i],
                    'description' => $request->description[$i],
                    'price' => $request->price[$i],
                    'amount' => $request->price[$i]*$request->qty[$i]
                ]);
            }   
        }
        else
        {
            $po = Po::create([
                'po_num' => $request->input('po_num'),
                'po' => $request->input('po'),
                'issuance_num' => $request->input('issuance_num'),
                'po_date' => $request->input('po_date'),
                'released_by' => $request->input('released_by'),
                'supplier' => $request->input('supplier'),
                'received_by' => $request->input('received_by'),
                'endorsed_to' => $request->input('endorsed_to')
            ]); 
            
            for($i = 0; $i < sizeof($request->qty); $i++)
            {
                PoItem::insert([
                    'po_id' => $po->id,
                    'qty' => $request->qty[$i],
                    'unit' => $request->unit[$i],
                    'description' => $request->description[$i],
                    'price' => $request->price[$i],
                    'amount' => $request->price[$i]*$request->qty[$i]
                ]);
            }
        }


        return redirect()->route('purchase_order.show', $po->id)->with('success' , 'Purchase order files added successfully');
    }

    public function show($id)
    {
        $po = Po::find($id);
        $items = PoItem::where('po_id', $po->id)->get();
        return view('po.show', ['po'=>$po, 'items'=>$items]);
    }

    public function edit($id)
    {
        $po = Po::find($id);

        return view('po.edit', ['po'=>$po]);
    }

    public function update(Request $request, $id)
    {
        $po = Po::find($id);

        $this->validate($request, [
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/', $name);  
                $data[] = $name;  
            } 
            
            $po->update([
                'po_num' => $request->input('po_num'),
                'issuance_num' => $request->input('issuance_num'),
                'po_date' => $request->input('po_date'),
                'released_by' => $request->input('released_by'),
                'supplier' => $request->input('supplier'),
                'received_by' => $request->input('received_by'),
                'endorsed_to' => $request->input('endorsed_to'),
                'filename' => json_encode($data)
            ]);
        }
        else
        {
            $po->update([
                'po_num' => $request->input('po_num'),
                'issuance_num' => $request->input('issuance_num'),
                'po_date' => $request->input('po_date'),
                'released_by' => $request->input('released_by'),
                'supplier' => $request->input('supplier'),
                'received_by' => $request->input('received_by'),
                'endorsed_to' => $request->input('endorsed_to')
            ]);
        }

        return redirect()->route('purchase_order.show', $po->id)->with('success' , 'Purchase order files edit successfully');
    }


    public function destroy($id)
    {
        $po = Po::find($id);
        $po->delete();

        return redirect()->route('purchase_order.index')->with('success' , 'Purchase order files deleted successfully');
    }
}
