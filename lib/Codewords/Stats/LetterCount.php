<?php namespace Codewords\Stats;

use Codewords\Stats\GameStats;
use Codewords\Board\Board;
use Codewords\Board\Cell;

/**
* Generates Letter count statistics for a Game
*/
class LetterCount extends GameStats
{
    public function doGenerateForCell(Board $board, Cell $cell)
    {
        $result = 0;
        $words = $board->getWordsContainingCell($cell);
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
