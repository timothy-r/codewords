<?php namespace Codewords\Stats;

use Codewords\IGameStats;
use Codewords\Game;

/**
* Generates stats on the Letters that follow each Letter in a Game
*/
class FollowingLetterCount implements IGameStats
{
    public function generate(Game $game)
    {
        $counts = array_map(function($i){ return [];}, range(1,26));
        unset($counts[0]);

        $cells = $game->getCells();
        $board = $game->getBoard();

        for($i = 1; $i < 27; $i++){
            $cell = $cells->at($i);
            $words = $board->getWordsContainingCell($cell);
            foreach($words as $word){
                for($c = 0; $c < ($word->length() - 1); $c++){
                    if ($word->at($c)->matches($cell)){
                        $following = $word->at($c+1);
                        // add the following cell - but only once!
                        $counts[$cell->getNumber()][$following->getNumber()]= $following;
                    }
                }
            }
        }

        return $counts;
    }

}
