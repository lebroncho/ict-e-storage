<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::all();

        return view('bill.index', ['bills'=>$bills]);
    }

    public function create()
    {
        return view('bill.create');
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
            $bill = Bill::create([
                'bill_name' => $request->input('bill_name'),
                'received_date' => $request->input('received_date'),
                'requested_by' => $request->input('requested_by'),
                'soa_num' => $request->input('soa_num'),
                'acc_num' => $request->input('acc_num'),
                'statement_date' => $request->input('statement_date'),
                'amount' => $request->input('amount'),
                'filename' => json_encode($data)
            ]); 
    
        }
        else
        {
            $bill = Bill::create([
                'bill_name' => $request->input('bill_name'),
                'received_date' => $request->input('received_date'),
                'requested_by' => $request->input('requested_by'),
                'soa_num' => $request->input('soa_num'),
                'acc_num' => $request->input('acc_num'),
                'statement_date' => $request->input('statement_date'),
                'amount' => $request->input('amount')
            ]);                
        }

        return redirect()->route('bill.show', $bill->id)->with('success' , 'Bill added successfully');
    }

    public function show($id)
    {

        $bill = Bill::find($id);

        return view('bill.show', ['bill'=>$bill]);
    }

    public function edit($id)
    {
        $bill = Bill::find($id);

        return view('bill.edit', ['bill'=>$bill]);
    }

    public function update(Request $request, $id)
    {
        $bill = Bill::find($id);

        /*$bill->update([
            'bill_name' => $request->input('bill_name'),
            'received_date' => $request->input('received_date'),
            'requested_by' => $request->input('requested_by'),
            'soa_num' => $request->input('soa_num'),
            'acc_num' => $request->input('acc_num'),
            'statement_date' => $request->input('statement_date'),
            'amount' => $request->input('amount')
        ]);*/

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
            $bill->update([
                'bill_name' => $request->input('bill_name'),
                'received_date' => $request->input('received_date'),
                'requested_by' => $request->input('requested_by'),
                'soa_num' => $request->input('soa_num'),
                'acc_num' => $request->input('acc_num'),
                'statement_date' => $request->input('statement_date'),
                'amount' => $request->input('amount'),
                'filename' => json_encode($data)
            ]); 
    
        }
        else
        {
            $bill->update([
                'bill_name' => $request->input('bill_name'),
                'received_date' => $request->input('received_date'),
                'requested_by' => $request->input('requested_by'),
                'soa_num' => $request->input('soa_num'),
                'acc_num' => $request->input('acc_num'),
                'statement_date' => $request->input('statement_date'),
                'amount' => $request->input('amount')
            ]);                
        }

        return redirect()->route('bill.show', $bill->id)->with('success' , 'Bill added successfully');

        return redirect()->route('bill.show', $bill->id)->with('success' , 'Bill edit successfully');
    }

    public function destroy($id)
    {
        $bill = Bill::find($id);
        $bill->delete();

        return redirect()->route('bill.index')->with('success' , 'Bill deleted successfully');
    }
}
