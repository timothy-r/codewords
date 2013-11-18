<?php namespace Codewords;

use Codewords\Board\Board;

interface IBoardRenderer
{
    public function render(Board $board);
}
