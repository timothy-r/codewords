<?php namespace Codewords;

use Codewords\Board\Board;

interface StrategyInterface
{
    public function solve(Board $board);
}
