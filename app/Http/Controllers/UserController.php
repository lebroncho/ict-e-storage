<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', ['users'=>$users]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation code
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:20',
        ]);

        $existuser = User::where('name', $request->input('name'))
                    ->where('username', $request->input('username'))
                    ->where('role', $request->input('role'))
                    ->exists();
                    
        //if validation fails
        if ($validator->fails() && $existuser == true) 
        {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }    

        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => bcrypt('12345'),
            'role' => $request->input('role')
        ]);

        return redirect()->route('user.index')->with('success' , 'User created successfully'); 
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('user.account', ['user'=>$user]);
    }

    public function update(Request $request, $id)
    {
        if(!$request->input('id'))
        {
            $user = User::find($id); 

            $user->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'password' => bcrypt($request->input('password'))
            ]);
    
            return redirect()->route('user.edit', $user->id)->with('success' , 'User updated successfully'); 
        }
        else
        {
            $user = User::find($request->input('id'));

            $user->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'role' => $request->input('role')
            ]);
    
            return redirect()->route('user.index')->with('success' , 'User updated successfully'); 
        }
    }

    // reset password ni siya, kining destroy na lang akong gamiton kay kapoy buhat og bag'o HASOL KEYOW!
    public function destroy($id)
    {
        $user = User::find($id);
        $user->update([
            'password' => bcrypt('12345')
        ]);

        return redirect()->route('user.index')->with('success', 'Password updated successfully');
    }
}
