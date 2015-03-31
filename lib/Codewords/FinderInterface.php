<?php namespace Codewords;

use Codewords\Board\Board;

interface FinderInterface
{
    public function solve(Board $board);
}
