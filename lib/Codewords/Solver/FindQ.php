<?php namespace Codewords\Solver;

use Codewords\Game;

/**
* Finds Cells that may be a Q letter
*/
class FindQ
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
        // find Cells followed by only 1 other Cell

        // check which Cells appear at the ends of Words - they are not Qs

        return $results;
    }
}
