<?php

namespace App\RepoRank;

use Illuminate\Database\Eloquent\Model;

class Repo extends Model
{

    public function updateRecord($rank, $stars, $forks){
      $this->rank  = $rank;
      $this->stars = $stars;
      $this->forks = $forks;
      $this->save();
    }
}
