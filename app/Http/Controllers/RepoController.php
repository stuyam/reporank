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
  public function rank(Request $request, GitHub $github, Repo $repoDB, Badge $badge){
    $username = $request->username;
    $name     = $request->name;
    $style    = $this->getStyle($request->input('style', 'default'));
    // $force    = $request->input('force', false);

    $repo = $repoDB->where('username', $username)->where('name', $name)->where('style', $style)->first();
    // if the repo exists in the database
    if($repo){
      // if the repo was updated in the last 24 hours, use that info
      if($repo->updated_at->timestamp > (time() - 60*60*24)){
        return $this->returnSVG($repo);
      }
      // get the updated repo info from github and update the database
      else {
        $gitRepo = $github->repo($username, $name);
        if( !$gitRepo ){
          return $this->failSVG($badge, $style);
        }
        $rank = $github->rank($gitRepo);

        $this->updateRepo($repo, $rank, $gitRepo['stargazers_count'], $badge->rank($rank, $style));

        return $this->returnSVG($repo);
      }

    } else {
      // make new record
      $gitRepo = $github->repo($username, $name);
      if( !$gitRepo ){
        return $this->failSVG($badge, $style);
      }
      $rank = $github->rank($gitRepo);

      // save the info to the db
      $repo                 = new Repo;
      $repo->rank           = $rank;
      $repo->username       = $username;
      $repo->name           = $name;
      $repo->style          = $style;
      $repo->stars          = $gitRepo['stargazers_count'];
      $repo->badge          = $badge->rank($rank, $style);
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

  private function getStyle($style){
    switch ($style) {
      case 'default':
        return'flat';
      case 'square':
        return 'flat-square';
      case 'plastic':
        return 'plastic';
      case 'social':
        return 'social';
      default:
        return 'flat';
    }
  }

  private function returnSVG($repo){
    return $this->respondConstruct($repo->badge);
  }

  private function failSVG($badge, $style){
    return $this->respondConstruct($badge->fail($style));
  }

  private function respondConstruct($badge){
    return \Response::make($badge)->header('Content-Type', 'image/svg+xml')->header('Cache-Control', 'private')->header('Etag', md5($badge));
  }

}
