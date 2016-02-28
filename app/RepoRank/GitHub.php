<?php

namespace App\RepoRank;

use \GitHub;

class GitHub
{
    public function repo($username, $name){
      // TODO: check for failure and return false if it doesn't work
      return GitHub::repo()->show($username, $name);
    }

    public function rank($repo){
      return GitHub::api('search')->repositories("stars:>=$repo[stargazers_count] forks:>=$repo[forks]")['total_count'];
    }
}
