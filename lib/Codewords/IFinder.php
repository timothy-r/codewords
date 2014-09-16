<?php namespace Codewords;

use Codewords\Board\Board;

interface IFinder
{
    public function solve(Board $board);
}
