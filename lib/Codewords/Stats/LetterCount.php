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
        $counts = [];
        $length = $board->getLength();
        for ($y = 0; $y < $length; $y++){
            for ($x = 0; $x < $length; $x++) {
                $cell = $board->getCell($x, $y);
                if (!$cell->isNull()){
                    if (!isset($counts[$cell->getNumber()])){
                        $counts[$cell->getNumber()] = 0;
                    }
                    $counts[$cell->getNumber()]++;
                }
            }
        }
        return $counts;
    }

}
