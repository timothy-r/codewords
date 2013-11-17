<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Cell;

/**
* Finds Cells that may be a U letter
*/
class FindU
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
            if ($this->isOrCanBeU($cell)){
                $result[]= $cell;
            }
        }
        return $results;
    }

    protected function isOrCanBeU(Cell $cell)
    {
        $character = $cell->getCharacter();

        if ($character === 'U'){
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

        // test if Cell appears last in any word
        $stats = $this->game->getStatsRepository()->getStat('LastLetter');
        $last_letters = $stats->generate($this->game);
        if ($last_letters[$cell->getNumber()] !== 0){
            return false;
        }

        return true;
    }
}
