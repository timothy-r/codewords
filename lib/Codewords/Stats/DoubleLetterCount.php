<?php namespace Codewords\Stats;

use Codewords\IGameStats;
use Codewords\Game;

/**
* Generates count of when Letters appear as double letters in a Word
*/
class DoubleLetterCount implements IGameStats
{
    public function generate(Game $game)
    {
        $counts = array_map(function($i){ return 0;}, range(1,26));
        unset($counts[0]);

        $cells = $game->getCells();
        $board = $game->getBoard();

        for($i = 1; $i < 27; $i++){
            $cell = $cells->at($i);
            $words = $board->getWordsContainingCell($cell);
            foreach($words as $word){
                // find each instance of $cell and see if next letter is same
                for($c = 0; $c < ($word->length() - 1); $c++){
                    if ($word->at($c)->matches($cell)){
                        if ($word->at($c+1)->matches($cell)){
                            $counts[$cell->getNumber()]++;
                        }
                    }
                }
            }
        }

        return $counts;
    }

}
