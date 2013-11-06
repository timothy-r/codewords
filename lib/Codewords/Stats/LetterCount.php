<?php namespace Codewords\Stats;

use Codewords\IGameStats;
use Codewords\Game;

/**
* Generates Letter count statistics for a Game
*/
class LetterCount implements IGameStats
{
    public function generate(Game $game)
    {
        $counts = array_map(function($i){ return 0;}, range(1,26));
        unset($counts[0]);
        
        $board = $game->getBoard();

        $length = $board->getLength();
        for ($y = 0; $y < $length; $y++){
            for ($x = 0; $x < $length; $x++) {
                $cell = $board->getCell($x, $y);
                if (!$cell->isNull()){
                    $counts[$cell->getNumber()]++;
                }
            }
        }
        return $counts;
    }

}
