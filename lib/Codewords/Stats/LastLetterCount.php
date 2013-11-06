<?php namespace Codewords\Stats;

use Codewords\IGameStats;
use Codewords\Game;

/**
* Generates count of when Letters are the last letter in a Word
*/
class LastLetterCount implements IGameStats
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
                if ($cell->matches($word->last())){
                    $counts[$cell->getNumber()]++;
                }
            }
        }

        return $counts;
    }

}