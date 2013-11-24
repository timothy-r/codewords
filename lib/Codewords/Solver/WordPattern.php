<?php namespace Codewords\Solver;

use Codewords\Board\Cell;
use Codewords\Board\CellCollection;
use Codewords\Board\Word;

/**
* Creates reg exp patterns for a Word containing a Cell with a specific letter
*/
class WordPattern
{
    public function __construct(CellCollection $cells)
    {
        $this->cells = $cells;
    }
    
    /**
    * return the pattern to use to match a Word using $letter in place of $cell
    * @todo restrict wild cards to chars that have still to be solved, eg replace . with [^A|B|C] if A, B and C have been solved
    * @return string
    */
    public function make($letter, Cell $cell, Word $word)
    {
        $pattern = '';
        $current = [];
        $wild_card_index = 1;
        $solved = $this->cells->getSolved();
        $chars = array_map(function($cell){ return $cell->getCharacter();}, $solved);
        if (!in_array($letter, $chars)){
            $chars [] = $letter;
        }
        sort($chars);
        // wild card = [^SOLVED|..]
        $wild_card = '[^' . implode('|',$chars) . ']';
        // iterate over Word's cells
        // wrap each wild card in pattern in () so back referencing is easier
        foreach($word as $index => $other_cell){
            if ($other_cell->matches($cell)){
                $pattern .= $letter;
            } else {
                if ($char = $other_cell->getCharacter()){
                    // check for back references
                    $pattern .= $char;
                } else {
                    if (isset($current[$other_cell->getNumber()])){
                        // use \$num
                        $pattern .= '\\' . $current[$other_cell->getNumber()];
                    } else {
                        $current[$other_cell->getNumber()] = $wild_card_index;
                        $pattern .= '(' . $wild_card . ')';
                        $wild_card_index++;
                    }
                }
            }
        }
        return '^'.$pattern.'$';
    }
}


