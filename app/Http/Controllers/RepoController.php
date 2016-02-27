<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GitHub;
use App\Models;

class RepoController extends Controller
{
    public function create(Request $request, GitHub $github){
      // get the repo using the info from the url
      $repo = $github->getRepo($request->username, $request->name);

      dd($repo);
      // search for the
      // dd(GitHub::api('search')->repositories("stars:>=$repo[stargazers_count] forks:>=$repo[forks]"));

      // $repo = new Repo;
      // $repo->username = $request->name;
      // $repo->name = $request->repo;
      // $repo->stars = $gitHubRepo->stargazers_count;
      // $repo->forks = $gitHubRepo->forks;
      // $repo->language = $gitHubRepo->language;
      // $repo->save();

    }

    private function getRepo(){

    }
}
