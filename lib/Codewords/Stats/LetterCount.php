<?php namespace Codewords\Stats;

use Codewords\IBoardStats;
use Codewords\Board;

/**
* Generates Letter count statistics for a Board
*/
class LetterCount implements IBoardStats
{
    public function generate(Board $board)
    {
        $counts = array_map(function($i){ return 0;}, range(1,26));
        unset($counts[0]);

        $length = $board->getLength();
        for ($y = 0; $y < $length; $y++){
            for ($x = 0; $x < $length; $x++) {
                $cell = $board->getCell($x, $y);
                if (!$cell->isNull()){
                    $counts[$cell->getNumber()]++;
                }
            }
        }
        return $counts;
    }

}
