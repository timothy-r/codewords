<?php namespace Codewords\Stats;

use Codewords\Stats\GameStats;
use Codewords\Game;
use Codewords\Cell;

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
            for($i = 0; $i < $word->length(); $i++){
                if ($word->at($i)->matches($cell)){
                    $result++;
                }
            }
        }
        return $result;
    }
}
