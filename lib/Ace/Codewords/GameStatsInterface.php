<?php namespace Ace\Codewords;

use Ace\Codewords\Board\Board;
use Ace\Codewords\Board\Cell;

/**
* interface to classes that generate Game statistics
*/
interface GameStatsInterface
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

