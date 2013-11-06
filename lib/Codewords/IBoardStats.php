<?php namespace Codewords;

use Codewords\Board;

/**
* interface to classes that generate Board statistics
*/
class IBoardStats
{
    /**
    * @return array
    */
    public function generate(Board $board);
}

