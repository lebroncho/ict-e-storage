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
}
