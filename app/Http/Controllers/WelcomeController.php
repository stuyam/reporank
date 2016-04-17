<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RepoRank\Repo;

class WelcomeController extends Controller
{
  public function index(Request $request, Repo $repo){
    $data = [
      'username' => $request->u,
      'repository' => $request->r,
      'all' => $repo->orderBy('rank', 'asc')->get()
    ];
    return view('welcome', $data);
  }

}
