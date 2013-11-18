<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Board\Cell;

/**
* Finds Cells that may be an I letter
*/
class FindI
{
    protected $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    /**
    * @return array of Cell objects
    */
    public function solve()
    {
        $results = [];
        
        $cells = $this->game->getCells();
        for ($c = 1; $c < 27; $c++) {
            $cell = $cells->at($c);
            if ($this->isOrCanBeI($cell)){
                $results[]= $cell;
            }
        }
        return $results;
    }

    protected function isOrCanBeI(Cell $cell)
    {
        $character = $cell->getCharacter();

        if ($character === 'I'){
            return true;
        }

        if ($character !== null) {
            return false;
        }
       
        // test if Cell appears as a double
        $stats = $this->game->getStatsRepository()->getStat('DoubleLetter');
        $double_letters = $stats->generate($this->game);
        if ($double_letters[$cell->getNumber()] > 0){
            return false;
        }

        return true;
    }
}
