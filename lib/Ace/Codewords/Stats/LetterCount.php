<?php namespace Ace\Codewords\Stats;

use Ace\Codewords\Stats\GameStats;
use Ace\Codewords\Board\Cell;

/**
* Generates Letter count statistics for a Game - really CellCount?
*/
class LetterCount extends GameStats
{
    protected function doGenerateForCell(Cell $cell)
    {
        $result = 0;
        $words = $cell->getWords();
        foreach($words as $word){
            // iterate over Cells in word
            foreach($word as $other_cell){
                if ($other_cell->matches($cell)){
                    $result++;
                }
            }
        }
        return $result;
    }
}
