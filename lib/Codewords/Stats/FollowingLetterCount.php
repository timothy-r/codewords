<?php namespace Codewords\Stats;

use Codewords\Stats\GameStats;
use Codewords\Game;
use Codewords\Cell;

/**
* Generates stats on the Letters that follow each Letter in a Game
*/
class FollowingLetterCount extends GameStats
{
    public function doGenerateForCell(Game $game, Cell $cell)
    {
        $result = [];
        $words = $game->getBoard()->getWordsContainingCell($cell);
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
