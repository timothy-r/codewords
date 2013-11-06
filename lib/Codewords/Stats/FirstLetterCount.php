<?php namespace Codewords\Stats;

use Codewords\IGameStats;
use Codewords\Game;

/**
* Generates count of when Letters are first letter in a Word
*/
class FirstLetterCount implements IGameStats
{
    public function generate(Game $board)
    {
        $counts = array_map(function($i){ return 0;}, range(1,26));
        unset($counts[0]);
        
        return $counts;
    }

}
