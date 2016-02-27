<?php

namespace App\GitHub;

use GrahamCampbell\GitHub\Facades\GitHub;

class GitHub
{
    public function getRepo($username, $name){
      // TODO: check for failure and return false if it doesn't work
      $repo = GitHub::repo()->show($request->username, $request->name);
    }

    public function rank($stars, $forks){
      return GitHub::api('search')->repositories("stars:>=$repo[stargazers_count] forks:>=$repo[forks]")['total_count'];
    }
}
