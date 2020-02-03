<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requisition;
use App\RequisitionItem;

class RequisitionController extends Controller
{
    public function index()
    {
        $requisitions = Requisition::all();
        return view('requisition.index', ['requisitions'=>$requisitions]);
    }

    public function create()
    {
        return view('requisition.create');
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
            $requisition = Requisition::create([
                'purpose' => $request->input('purpose'),
                'requisition_date' => $request->input('requisition_date'),
                'requested_by' => $request->input('requested_by'),
                'filename' => json_encode($data)
            ]); 
            
            for($i = 0; $i < sizeof($request->qty); $i++)
            {
                RequisitionItem::insert([
                    'requisition_id' => $requisition->id,
                    'qty' => $request->qty[$i],
                    'unit' => $request->unit[$i],
                    'description' => $request->description[$i]
                ]);
            }
            
        }
        else
        {
            $requisition = Requisition::create([
                'purpose' => $request->input('purpose'),
                'requisition_date' => $request->input('requisition_date'),
                'requested_by' => $request->input('requested_by')
            ]); 

            for($i = 0; $i < sizeof($request->qty); $i++)
            {
                RequisitionItem::insert([
                    'requisition_id' => $requisition->id,
                    'qty' => $request->qty[$i],
                    'unit' => $request->unit[$i],
                    'description' => $request->description[$i]
                ]);
            }
        }


        return redirect()->route('requisition.show', $requisition->id)->with('success' , 'Requisition added successfully');
    }

    public function show($id)
    {
        $requisition = Requisition::find($id);
        $items = RequisitionItem::where('requisition_id', $requisition->id)->get();

        return view('requisition.show', ['requisition'=>$requisition, 'items'=>$items]);
    }

    public function edit($id)
    {
        $requisition = Requisition::find($id);
        $items = RequisitionItem::where('requisition_id', $requisition->id)->get();

        return view('requisition.edit', ['requisition'=>$requisition, 'items'=>$items]);
    }

    public function update(Request $request, $id)
    {
        $requisition = Requisition::find($id);

        $requisition->update([
            'purpose' => $request->input('purpose'),
            'requisition_date' => $request->input('requisition_date'),
            'requested_by' => $request->input('requested_by')
        ]);

        return redirect()->route('requisition.show', $requisition->id)->with('success' , 'Requisition edit successfully');
    }


    public function destroy($id)
    {
        $requisition = Requisition::find($id);
        $requisition->delete();

        return redirect()->route('requisition.index')->with('success' , 'Requisition deleted successfully');
    }
}
