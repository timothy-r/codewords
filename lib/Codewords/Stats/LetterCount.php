<?php namespace Codewords\Stats;

use Codewords\Stats\GameStats;
use Codewords\Game;
use Codewords\Board\Cell;

/**
* Generates Letter count statistics for a Game
*/
class LetterCount extends GameStats
{
    public function doGenerateForCell(Game $game, Cell $cell)
    {
        $result = 0;
        $words = $game->getBoard()->getWordsContainingCell($cell);
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
