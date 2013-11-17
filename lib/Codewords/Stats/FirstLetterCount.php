<?php namespace Codewords\Stats;

use Codewords\Stats\GameStats;
use Codewords\Game;
use Codewords\Cell;

/**
* Generates count of when Letters are first letter in a Word
*/
class FirstLetterCount extends GameStats
{
    public function doGenerateForCell(Game $game, Cell $cell)
    {
        $result = 0;
        $words = $game->getBoard()->getWordsContainingCell($cell);
        foreach($words as $word){
            if ($cell->matches($word->first())){
                $result++;
            }
        }
        return $result;
    }
}
