<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Other;

class OtherController extends Controller
{
    public function index()
    {
        $others = Other::all();

        return view('other.index', ['others'=>$others]);
    }

    public function create()
    {
        return view('other.create');
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
            $other = Other::create([
                'title' => $request->input('title'),
                'created_at' => $request->input('created_at'),
                'filename' => json_encode($data)
            ]);
        }
        else
        {
            $request = Other::create([
                'title' => $request->input('title'),
                'created_at' => $request->input('created_at')
            ]);
        }

        return redirect()->route('other.show', $other->id)->with('success' , 'File added successfully'); 
    }

    public function show($id)
    {
        $other = Other::find($id);

        return view('other.show', ['other'=>$other]);
    }

    public function edit($id)
    {
        $other = Other::find($id);

        return view('other.edit', ['other'=>$other]);
    }
    
    public function update(Request $request, $id)
    {
        $other = Other::find($id);

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
            $other->update([
                'title' => $request->input('title'),
                'created_at' => $request->input('created_at'),
                'filename' => json_encode($data)
            ]);
        }
        else
        {
            $other->update([
                'title' => $request->input('title'),
                'created_at' => $request->input('created_at')
            ]);
        }

        return redirect()->route('other.show', $other->id)->with('success' , 'File updated successfully');
    }

    public function destroy($id)
    {
        $other = Other::find($id);
        $other->delete();

        return redirect()->route('other.index')->with('success', 'File deleted successfully');
    }
}
