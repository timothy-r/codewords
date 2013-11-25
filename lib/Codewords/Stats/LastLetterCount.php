<?php namespace Codewords\Stats;

use Codewords\Stats\GameStats;
use Codewords\Board\Board;
use Codewords\Board\Cell;

/**
* Generates count of when Letters are the last letter in a Word
*/
class LastLetterCount extends GameStats
{
    public function doGenerateForCell(Board $board, Cell $cell)
    {
        $result = 0;
        $words = $board->getWordsContainingCell($cell);
        foreach($words as $word){
            if ($cell->matches($word->last())){
                $result++;
            }
        }
        return $result;
    }
}
