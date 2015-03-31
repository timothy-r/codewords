<?php namespace Ace\Codewords;

use Ace\Codewords\Board\Board;

interface BoardRendererInterface
{
    public function render(Board $board);
}
