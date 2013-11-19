<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Board\Cell;

/**
* Finds Cells that may be an specified letter
*/
class FindLetter
{
    protected $game;

    protected $letter;

    protected $rules;

    public function __construct(Game $game, $letter, array $rules)
    {
        $this->game = $game;
        $this->letter = $letter;
        $this->rules = $rules;
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
            if ($this->isOrCanBeLetter($cell)){
                $results[]= $cell;
            }
        }
        return $results;
    }

    protected function isOrCanBeLetter(Cell $cell)
    {
        $character = $cell->getCharacter();

        if ($character === $this->letter){
            return true;
        }

        // char is set but it's not this one
        if ($character !== null) {
            return false;
        }
        
        // apply rules here

        // use dictionary to test words that contain this cell
        return true;
    }
}
