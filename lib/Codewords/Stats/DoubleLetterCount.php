<?php namespace Codewords\Stats;

use Codewords\Stats\GameStats;
use Codewords\Board\Cell;

/**
* Generates count of when Letters appear as double letters in a Word
*/
class DoubleLetterCount extends GameStats
{
    protected function doGenerateForCell(Cell $cell)
    {
        $result = 0;
        $words = $cell->getWords();

        foreach($words as $word){
            // find each instance of $cell and see if next letter is same
            for($c = 0; $c < ($word->length() - 1); $c++){
                if ($word->at($c)->matches($cell) && $word->at($c+1)->matches($cell)){
                        $result++;
                }
            }
        }
        return $result;
    }
}
