<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Solver\CellOptions;
use Codewords\Board\CellCollection;
use Codewords\Solver\FinderFactory;

class StrategyB
{
    public function solve(Game $game)
    {
        $letters = ['e','t','a','o','i','n','s','h','r','d','l','c','u','m','w','f','g','y','p','b','v','k','j','x','q','z'];
        $options = new CellOptions($game);

        while (count($letters)) {
            $results = $options->solveAll($letters);
            $letters = array_keys($results);
        }
    }
}
