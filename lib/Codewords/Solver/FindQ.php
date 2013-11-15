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
        $following_letter_count = $this->game->getStatsRepository()->getStat('FollowingLetter');
        $following_letters = $following_letter_count->generate($this->game);
        foreach ($following_letters as $number => $value){
            if (count($value) === 1){
                // test if value can be a U or is a U
                $cell = current($value);
                if ($cell->getCharacter() === 'U' || $cell->getCharacter() === null){
                    $result = $this->game->getCells()->at($number);
                    $results []= $result;
                }
            }
        }

        // check which Cells appear at the ends of Words - they are not Qs

        return $results;
    }
}