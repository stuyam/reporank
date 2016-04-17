<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
  public function index(Request $request){
    $username = $request->u;
    $repository = $request->r;
    return view('welcome')->with(compact('username'))->with(compact('repository'));
  }

}
