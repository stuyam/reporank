<?php

namespace App\RepoRank;

use \GitHub;

class GitHub
{
    public function repo($username, $name){
      // check for failure and return false if it doesn't work
      $repo = GitHub::repo()->show($username, $name);
      if( isset($repo) ){
        return false;
      } else {
        return $repo;
      }
    }

    public function rank($repo){
      return GitHub::api('search')->repositories("stars:>=$repo[stargazers_count]")['total_count'];
    }
}
