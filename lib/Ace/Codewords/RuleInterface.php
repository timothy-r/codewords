<?php namespace Codewords;

use Codewords\Board\Cell;

/**
* Tests if a Cell passes a Rule
*/
interface RuleInterface
{
    public function passes(Cell $cell);
}
