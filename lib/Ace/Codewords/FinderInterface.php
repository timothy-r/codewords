<?php namespace Ace\Codewords;

use Ace\Codewords\Board\Board;

interface FinderInterface
{
    public function solve(Board $board);
}
