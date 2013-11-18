<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Board\Cell;

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
                if ($this->isOrCanBeU($cell)){
                    $result = $this->game->getCells()->at($number);
                    $results[$number] = $result;
                }
            }
        }

        // check which Cells appear at the ends of Words - they are not Qs
        $stats = $this->game->getStatsRepository()->getStat('LastLetter');
        $last_letters = $stats->generate($this->game);
        foreach($results as $number => $result) {
            if ($last_letters[$number] > 0){
                // remove from results
                unset($results[$number]);
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
