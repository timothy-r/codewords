<?php namespace Codewords;

use Codewords\Board\Board;
use Codewords\Board\Cell;

/**
* interface to classes that generate Game statistics
*/
interface IGameStats
{
    /**
    * @return array
    */
    public function generate(Board $board);

    /**
    * @return mixed
    */
    public function generateForCell(Cell $cell);
}

