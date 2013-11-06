<?php namespace Codewords;

use Codewords\Board;

/**
* interface to classes that generate Board statistics
*/
interface IBoardStats
{
    /**
    * @return array
    */
    public function generate(Board $board);
}

