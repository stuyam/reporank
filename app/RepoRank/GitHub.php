<?php

namespace App\RepoRank;

use \GitHub;

class GitHub
{
    public function repo($username, $name){
      // check for failure and return false if it doesn't work
      try {
        $repo = GitHub::repo()->show($username, $name);
        return $repo;
      } catch (Github\Exception\RuntimeException $e) {
        return false;
      }
    }

    public function rank($repo){
      return GitHub::api('search')->repositories("stars:>=$repo[stargazers_count]")['total_count'];
    }
}
