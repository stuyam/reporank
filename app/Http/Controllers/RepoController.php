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

  private function handle($username, $name, $github, $repoDB, $badge){
    $repo = $repoDB->where('username', $username)->where('name', $name)->first();
    // if the repo exists in the database
    if($repo){
      // if the repo was updated in the last 24 hours, use that info
      if($repo->updated_at->timestamp > (time() - 60*60*24) ){
        return $this->returnSVG($repo);
      }
      // if there are other repos with the same number of stars updated in the last 24 hours, use their rank
      else if($cachedRepo = $repoDB->where('stars', $repo->stars)->where('updated_at', '>=', (time() - 60*60*24))->orderBy('updated_at', 'DESC')->first()) {
        $this->updateRepo($repo, $cachedRepo->rank, $cachedRepo->stars, $cachedRepo->badge);
        return $this->returnSVG($repo);
      }
      // get the updated repo info from github and update the database
      else {
        $gitRepo = $github->repo($username, $name);
        if( !$gitRepo ){
          return $this->failSVG($badge);
        }
        $rank = $github->rank($gitRepo);

        $this->updateRepo($repo, $rank, $gitRepo['stargazers_count'], $badge->rank($rank));

        return $this->returnSVG($repo);
      }

    } else {
      // make new record
      $gitRepo = $github->repo($username, $name);
      if( !$gitRepo ){
        return $this->failSVG($badge);
      }
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

  private function updateRepo($repo, $rank, $stars, $badge){
    $repo->rank  = $rank;
    $repo->stars = $stars;
    $repo->badge = $badge;
    $repo->touch();
    $repo->save();
  }

  private function returnSVG($repo){
    return \Response::make($repo->badge)->header('Content-Type', 'image/svg+xml');
  }

  private function failSVG($badge){
    return \Response::make($badge->fail())->header('Content-Type', 'image/svg+xml');
  }

}
