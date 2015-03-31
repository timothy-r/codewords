<?php namespace Codewords;

use Codewords\Board\Board;

interface BoardRendererInterface
{
    public function render(Board $board);
}
