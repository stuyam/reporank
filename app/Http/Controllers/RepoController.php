<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RepoRank\GitHub;
use App\RepoRank\Repo;

class RepoController extends Controller
{
    public function create(Request $request, GitHub $github, Repo $repo){
      $username = $request->username;
      $name     = $request->name;

      $repo = $repo->where('username', $username)->where('name', $name)->first();

      // if the repo exists in the DB
      if($repo){

        if($repo->updated_at->timestamp > (time() - 60*60*24) ){
          // return cached image
          return $repo->rank.'cached';
        } else {
          // get updated info
          $gitRepo = $github->repo($username, $name);
          $rank = $github->rank($gitRepo);

          $repo->rank  = $rank;
          $repo->stars = $gitRepo['stargazers_count'];
          $repo->forks = $gitRepo['forks'];
          $repo->touch();
          $repo->save();

          return $rank.'updated';
        }

      } else {
        // make new record
        $gitRepo = $github->repo($request->username, $request->name);
        $rank = $github->rank($gitRepo);

        // save the info to the db
        $repo           = new Repo;
        $repo->rank     = $rank;
        $repo->username = $request->username;
        $repo->name     = $request->name;
        $repo->stars    = $gitRepo['stargazers_count'];
        $repo->forks    = $gitRepo['forks'];
        $repo->language = $gitRepo['language'];
        $repo->save();

        return $rank.'new';
      }
    }
}
