<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Req;

class RequestController extends Controller
{
    public function index()
    {
        $requests = Req::all();

        return view('request.index', ['requests'=>$requests]);
    }

    public function create()
    {
        return view('request.create');
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
            $request = Req::create([
                'requested_by' => $request->input('requested_by'),
                'office' => $request->input('office'),
                'designation' => $request->input('designation'),
                'request' => $request->input('request'),
                'date_requested' => $request->input('date_requested'),
                'filename' => json_encode($data)
            ]);
        }
        else
        {
            $request = Req::create([
                'requested_by' => $request->input('requested_by'),
                'office' => $request->input('office'),
                'designation' => $request->input('designation'),
                'request' => $request->input('request'),
                'date_requested' => $request->input('date_requested')
            ]);
        }

        return redirect()->route('request.show', $request->id)->with('success' , 'Request added successfully');
    }

    public function show($id)
    {
        $request = Req::find($id);

        return view('request.show', ['request'=>$request]);
    }

    public function edit($id)
    {
        $request = Req::find($id);

        return view('request.edit', ['request'=>$request]);
    }

    public function update(Request $request, $id)
    {
        $request = Req::find($id);

        $request->update([
            'type' => $request->input('type'),
            'subject' => $request->input('subject'),
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'noted_by' => $request->input('noted_by'),
            'cc' => $request->input('cc'),
            'date_received' => $request->input('date_received')
        ]);

        return redirect()->route('request.show', $request->id)->with('success' , 'Request edit successfully');
    }

    public function destroy($id)
    {
        $request = Req::find($id);
        $request->delete();

        return redirect()->route('request.index')->with('success' , 'Request deleted successfully');
    }

    public function replaceImage(Request $request, $id)
    {
        $request = Req::find($id);
        
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
            $request->update([
                'filename' => json_encode($data)
            ]);
        }
    }
}
