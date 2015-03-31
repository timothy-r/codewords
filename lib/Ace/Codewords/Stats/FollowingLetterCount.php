<?php namespace Ace\Codewords\Stats;

use Ace\Codewords\Stats\GameStats;
use Ace\Codewords\Board\Cell;

/**
* Generates stats on the Letters that follow each Letter in a Board
*/
class FollowingLetterCount extends GameStats
{
    protected function doGenerateForCell(Cell $cell)
    {
        $result = [];
        $words = $cell->getWords();
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
