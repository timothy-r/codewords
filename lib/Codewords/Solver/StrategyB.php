<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Solver\CellOptions;
use Codewords\Board\CellCollection;
use Codewords\Solver\FinderFactory;

class StrategyB
{
    public function __construct(CellOptions $options)
    {
        $this->options = $options;
    }

    public function solve()
    {
        $letters = ['e','t','a','o','i','n','s','h','r','d','l','c','u','m','w','f','g','y','p','b','v','k','j','x','q','z'];

        while (count($letters)) {
            $results = $this->options->solveAll($letters);
            $letters = array_keys($results);
        }
    }
}
