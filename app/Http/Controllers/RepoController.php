<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RepoRank\GitHub;
use App\RepoRank\Repo;
use App\RepoRank\Badge;

class RepoController extends Controller
{
  public function rank(Request $request, GitHub $github, Repo $repo, Badge $badge){
    $username = $request->username;
    $name     = $request->name;
    return $this->handle($username, $name, $github, $repo, $badge);
  }

  private function handle($username, $name, $github, $repo, $badge){
    $repo = $repo->where('username', $username)->where('name', $name)->first();
    // if the repo exists in the DB
    if($repo){

      if($repo->updated_at->timestamp > (time() - 60*60*24) ){
        return $this->returnSVG($repo);
      } else {
        // get updated info
        $gitRepo = $github->repo($username, $name);
        $rank = $github->rank($gitRepo);

        $repo->rank           = $rank;
        $repo->stars          = $gitRepo['stargazers_count'];
        $repo->badge          = $badge->rank($rank);
        $repo->touch();
        $repo->save();

        return $this->returnSVG($repo);
      }

    } else {
      // make new record
      $gitRepo = $github->repo($username, $name);
      $rank = $github->rank($gitRepo);

      // save the info to the db
      $repo                 = new Repo;
      $repo->rank           = $rank;
      $repo->username       = $username;
      $repo->name           = $name;
      $repo->stars          = $gitRepo['stargazers_count'];
      $repo->badge          = $badge->rank($rank);
      $repo->save();

      return $this->returnSVG($repo);
    }
  }

  private function returnSVG($repo){
    if($languageRank){
      return \Response::make($repo->badge_language)->header('Content-Type', 'image/svg+xml');
    } else {
      return \Response::make($repo->badge)->header('Content-Type', 'image/svg+xml');
    }
  }

}
