<?php namespace Codewords\Solver;

use Codewords\IFinder;
use Codewords\Game;
use Codewords\Board\Cell;

/**
* Finds Cells that may be a specific Letter
*/
class FindLetter implements IFinder
{
    /**
    * @var string
    */
    protected $letter;

    /**
    * @var array
    */
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
            
            // char is set but it's not this one
            if ($character !== null) {
                continue;
            }

            if ($this->applyRules($cell)){
                $results[]= $cell;
            }

            // use dictionary to test words that contain this cell
        }
        return $results;
    }
    
    /**
    * Test that all Rules of this Finder pass
    */
    protected function applyRules(Cell $cell)
    {
        foreach($this->rules as $rule){
            if (!$rule->passes($cell)){
                return false;
            }
        }
        return true;
    }
}
