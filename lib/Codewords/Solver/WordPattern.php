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
    * @todo add support for back references
    * @todo restrict wild cards to chars that have still to be solved, eg replace . with [^A|B|C] if A, B and C have been solved
    * @return string
    */
    public function make($letter, Cell $cell, Word $word)
    {
        $pattern = '';
        // iterate over Word's cells
        for ($i = 0; $i < $word->length(); $i++){
            $other = $word->at($i);
            if ($other->matches($cell)){
                $pattern .= $letter;
            } else {
                if ($char = $other->getCharacter()){
                    $pattern .= $char;
                } else {
                    $pattern .= '.';
                }
            }
        }
        return '^'.$pattern.'$';
    }
}
