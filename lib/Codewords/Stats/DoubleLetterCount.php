<?php namespace Codewords\Stats;

use Codewords\Stats\GameStats;
use Codewords\Game;
use Codewords\Board\Cell;

/**
* Generates count of when Letters appear as double letters in a Word
*/
class DoubleLetterCount extends GameStats
{
    public function doGenerateForCell(Game $game, Cell $cell)
    {
        $result = 0;
        $words = $game->getBoard()->getWordsContainingCell($cell);

        foreach($words as $word){
            // find each instance of $cell and see if next letter is same
            for($c = 0; $c < ($word->length() - 1); $c++){
                if ($word->at($c)->matches($cell)){
                    if ($word->at($c+1)->matches($cell)){
                        $result++;
                    }
                }
            }
        }
        return $result;
    }
}
