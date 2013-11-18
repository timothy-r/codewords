<?php namespace Codewords;

use Codewords\Game;
use Codewords\Board\Cell;

/**
* interface to classes that generate Game statistics
*/
interface IGameStats
{
    /**
    * @return array
    */
    public function generate(Game $game);

    /**
    * @return mixed
    */
    public function generateForCell(Game $game, Cell $cell);
}

