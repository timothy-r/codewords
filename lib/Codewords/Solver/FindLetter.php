<?php namespace Codewords\Solver;

use Codewords\IFinder;
use Codewords\Game;
use Codewords\Board\Cell;

/**
* Finds Cells that may be a specific Letter
*/
class FindLetter implements IFinder
{
    protected $letter;

    protected $rules;

    public function __construct($letter, array $rules)
    {
        $this->letter = $letter;
        $this->rules = $rules;
    }

    /**
    * @return array of Cell objects
    */
    public function solve(Game $game)
    {
        $results = [];
        
        $cells = $game->getCells();
        for ($c = 1; $c < 27; $c++) {
            $cell = $cells->at($c);
            $character = $cell->getCharacter();

            if ($character === $this->letter){
                return [$cell];
            }

            if ($this->isOrCanBeLetter($cell)){
                $results[]= $cell;
            }
        }
        return $results;
    }

    protected function isOrCanBeLetter(Cell $cell)
    {
        $character = $cell->getCharacter();
        // char is set but it's not this one
        if ($character !== null) {
            return false;
        }
        
        // apply rules here
        foreach($this->rules as $rule){
            if (!$rule->passes($cell)){
                return false;
            }
        }

        // use dictionary to test words that contain this cell

        return true;
    }
}
