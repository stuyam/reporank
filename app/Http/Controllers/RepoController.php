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
    return $this->handle($username, $name, false, $github, $repo, $badge);
  }

  public function rankLanguage(Request $request, GitHub $github, Repo $repo, Badge $badge){
    $username = $request->username;
    $name     = $request->name;
    return $this->handle($username, $name, true, $github, $repo, $badge);
  }

  private function handle($username, $name, $languageRank, $github, $repo, $badge){
    $repo = $repo->where('username', $username)->where('name', $name)->first();
    // if the repo exists in the DB
    if($repo){

      if($repo->updated_at->timestamp > (time() - 60*60*24) ){
        return $this->returnSVG($repo, $languageRank);
      } else {
        // get updated info
        $gitRepo = $github->repo($username, $name);
        $rank = $github->rank($gitRepo);
        $rankLanguage = $github->rankLanguage($gitRepo);

        $repo->rank           = $rank;
        $repo->rank_language  = $rankLanguage;
        $repo->stars          = $gitRepo['stargazers_count'];
        $repo->forks          = $gitRepo['forks'];
        $repo->badge          = $badge->rank($rank);
        $repo->badge_language = $badge->rankLanguage($rankLanguage, $repo->language);
        $repo->touch();
        $repo->save();

        return $this->returnSVG($repo, $languageRank);
      }

    } else {
      // make new record
      $gitRepo = $github->repo($username, $name);
      $rank = $github->rank($gitRepo);
      $rankLanguage = $github->rankLanguage($gitRepo);

      // save the info to the db
      $repo                 = new Repo;
      $repo->rank           = $rank;
      $repo->rank_language  = $rankLanguage;
      $repo->username       = $username;
      $repo->name           = $name;
      $repo->stars          = $gitRepo['stargazers_count'];
      $repo->forks          = $gitRepo['forks'];
      $repo->badge          = $badge->rank($rank);
      $repo->badge_language = $badge->rankLanguage($rankLanguage, $gitRepo['language']);
      $repo->language       = $gitRepo['language'];
      $repo->save();

      return $this->returnSVG($repo, $languageRank);
    }
  }

  private function returnSVG($repo, $languageRank){
    if($languageRank){
      return \Response::make($repo->badge_language)->header('Content-Type', 'image/svg+xml');
    } else {
      return \Response::make($repo->badge)->header('Content-Type', 'image/svg+xml');
    }
  }

}
