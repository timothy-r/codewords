<?php namespace Ace\Codewords\Stats;

use Ace\Codewords\Stats\GameStats;
use Ace\Codewords\Board\Cell;

/**
* Generates count of when Letters are the last letter in a Word
*/
class LastLetterCount extends GameStats
{
    protected function doGenerateForCell(Cell $cell)
    {
        $result = 0;
        $words = $cell->getWords();
        foreach($words as $word){
            if ($cell->matches($word->last())){
                $result++;
            }
        }
        return $result;
    }
}
