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
