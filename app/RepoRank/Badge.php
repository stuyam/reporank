<?php

namespace App\RepoRank;

use \Badger;

class Badge
{
    public function rank($rank, $style){
      return Badger::generate("GitHub Rank", $this->numberReadable($rank), '#4c1', $this->badgeStyle($style));
    }

    public function fail($style){
      return Badger::generate("Repo Not Found", "404", '#4c1', $this->badgeStyle($style));
    }

    private function badgeStyle($style){
      switch ($style) {
        case 'square':
          return 'flat-square';
        case 'plastic':
          return 'plastic';
        case 'social':
          return 'social';
        case 'default':
        default:
          return 'flat';
      }
    }

    private function numberReadable($rank){
      return number_format($rank).$this->ordinal_suffix($rank);
    }

    //http://stackoverflow.com/questions/6604904/add-rd-or-th-or-st-dependant-on-number
    private function ordinal_suffix($num){
      $num = $num % 100; // protect against large numbers
      if($num < 11 || $num > 13){
         switch($num % 10){
          case 1: return 'st';
          case 2: return 'nd';
          case 3: return 'rd';
        }
      }
      return 'th';
    }
}
