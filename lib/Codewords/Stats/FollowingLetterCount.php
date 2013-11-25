<?php namespace Codewords\Stats;

use Codewords\Stats\GameStats;
use Codewords\Board\Board;
use Codewords\Board\Cell;

/**
* Generates stats on the Letters that follow each Letter in a Board
*/
class FollowingLetterCount extends GameStats
{
    public function doGenerateForCell(Board $board, Cell $cell)
    {
        $result = [];
        $words = $board->getWordsContainingCell($cell);
        foreach($words as $word){
            for($c = 0; $c < ($word->length() - 1); $c++){
                if ($word->at($c)->matches($cell)){
                    $following = $word->at($c+1);
                    // add the following cell - but only once!
                    $result[$following->getNumber()]= $following;
                }
            }
        }
        return $result;
    }
}
