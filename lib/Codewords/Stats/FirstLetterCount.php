<?php namespace Codewords\Stats;

use Codewords\IBoardStats;
use Codewords\Board;

/**
* Generates count of when Letters are first letter in a Word
*/
class FirstLetterCount implements IBoardStats
{
    public function generate(Board $board)
    {
        $counts = array_map(function($i){ return 0;}, range(1,26));
        unset($counts[0]);
        //$length = $board->getLength();
        
        return $counts;
    }

}
