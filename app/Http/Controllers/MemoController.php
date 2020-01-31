<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Memo;

class MemoController extends Controller
{
    public function index()
    {
        $memos = Memo::all();
        return view('memo.index', ['memos'=>$memos]);
    }

    public function create()
    {
        return view('memo.create');
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
            $memo = Memo::create([
                'type' => $request->input('type'),
                'subject' => $request->input('subject'),
                'from' => $request->input('from'),
                'to' => $request->input('to'),
                'noted_by' => $request->input('noted_by'),
                'cc' => $request->input('cc'),
                'date_received' => $request->input('date_received'),
                'filename' => json_encode($data)
            ]);    
        }
        else
        {
            $memo = Memo::create([
                'type' => $request->input('type'),
                'subject' => $request->input('subject'),
                'from' => $request->input('from'),
                'to' => $request->input('to'),
                'noted_by' => $request->input('noted_by'),
                'cc' => $request->input('cc'),
                'date_received' => $request->input('date_received')
            ]);
        }


        return redirect()->route('memo.show', $memo->id)->with('success' , 'Memo added successfully');
    }

    public function show($id)
    {
        $memo = Memo::find($id);

        return view('memo.show', ['memo'=>$memo]);
    }

    public function edit($id)
    {
        $memo = Memo::find($id);

        return view('memo.edit', ['memo'=>$memo]);
    }

    public function update(Request $request, $id)
    {
        $memo = Memo::find($id);

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
            $memo->update([
                'type' => $request->input('type'),
                'subject' => $request->input('subject'),
                'from' => $request->input('from'),
                'to' => $request->input('to'),
                'noted_by' => $request->input('noted_by'),
                'cc' => $request->input('cc'),
                'date_received' => $request->input('date_received'),
                'filename' => json_encode($data)
            ]);    
        }
        else
        {
            $memo->update([
                'type' => $request->input('type'),
                'subject' => $request->input('subject'),
                'from' => $request->input('from'),
                'to' => $request->input('to'),
                'noted_by' => $request->input('noted_by'),
                'cc' => $request->input('cc'),
                'date_received' => $request->input('date_received')
            ]);
        }
    
        return redirect()->route('memo.show', $memo->id)->with('success' , 'Memo edit successfully');
    }


    public function destroy($id)
    {
        $memo = Memo::find($id);
        $memo->delete();

        return redirect()->route('memo.index')->with('success' , 'Memo deleted successfully');
    }
}
