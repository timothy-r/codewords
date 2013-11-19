<?php namespace Codewords;

use Codewords\Board\Cell;

/**
* Tests if a Cell passes a Rule
*/
interface IRule
{
    public function passes(Cell $cell);
}
