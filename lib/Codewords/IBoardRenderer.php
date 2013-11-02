<?php namespace Codewords;

use Codewords\Board;

interface IBoardRenderer
{
    public function render(Board $board);
}
