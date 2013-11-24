<?php namespace Codewords\Solver;

use Codewords\Board\Cell;
use Codewords\Board\Word;

/**
* Creates reg exp patterns for a Word containing a Cell with a specific letter
*/
class WordPattern
{
    public function __construct()
    {
    }
    
    /**
    * return the pattern to use to match a Word using $letter in place of $cell
    * @todo add support for back references to letters that appear multiple times
    * @todo restrict wild cards to chars that have still to be solved, eg replace . with [^A|B|C] if A, B and C have been solved
    * @return string
    */
    public function make($letter, Cell $cell, Word $word)
    {
        $pattern = '';
        $current = [];
        $solved_index = 1;
        // iterate over Word's cells
        foreach($word as $index => $other_cell){
            if ($other_cell->matches($cell)){
                $pattern .= '(' . $letter . ')';
                $solved_index++;
            } else {
                if ($char = $other_cell->getCharacter()){
                    // check for back references
                    if (isset($current[$other_cell->getNumber()])){
                        // use \$num
                        $pattern .= '\\' . $current[$other_cell->getNumber()];
                    } else {
                        $current[$other_cell->getNumber()] = $solved_index;
                        $solved_index++;
                        $pattern .= '('.$char.')';
                    }
                } else {
                    $pattern .= '.';
                }
            }
        }
        return '^'.$pattern.'$';
    }
}
