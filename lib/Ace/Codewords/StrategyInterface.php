<?php namespace Ace\Codewords;

use Ace\Codewords\Board\Board;

interface StrategyInterface
{
    public function solve(Board $board);
}
