<?php namespace Codewords\Stats;

use Codewords\Stats\GameStats;
use Codewords\Board\Cell;

/**
* Generates count of when Letters are first letter in a Word
*/
class FirstLetterCount extends GameStats
{
    public function doGenerateForCell(Cell $cell)
    {
        $result = 0;
        $words = $cell->getWords();
        foreach($words as $word){
            if ($cell->matches($word->first())){
                $result++;
            }
        }
        return $result;
    }
}
