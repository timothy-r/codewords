<?php namespace Codewords;

use Codewords\Game;

interface IFinder
{
    public function solve(Game $game);
}
