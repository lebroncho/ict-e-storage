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
            
            $rows = $request->input('rows');

            foreach ($rows as $row)
            {
                $items[] = [
                    'requisition_id' => $requisition->id,
                    'qty' => $row['qty'],
                    'unit' => $row['unit'],
                    'description' => $row['description']
                ];
            }

            
            RequisitionItem::insert($items);   
            //$requisition->requisition_items()->saveMany($items);
        }
        else
        {
            $requisition = Requisition::create([
                'purpose' => $request->input('purpose'),
                'requisition_date' => $request->input('requisition_date'),
                'requested_by' => $request->input('requested_by')
            ]);  
            
            $rows = $request->input('rows');

            foreach ($rows as $row)
            {
                $items[] = [
                    'requisition_id' => $requisition->id,
                    'qty' => $row['qty'],
                    'unit' => $row['unit'],
                    'description' => $row['description']
                ];
            }

            dd($rows);
            
            RequisitionItem::insert($items);   
            //$requisition->requisition_items()->saveMany($items);
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
