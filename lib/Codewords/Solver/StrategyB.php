<?php namespace Codewords\Solver;

use Codewords\Solver\CellOptions;
use Timer\Clock;

class StrategyB
{
    public function __construct(CellOptions $options)
    {
        $this->options = $options;
    }

    public function solve()
    {
        $letters = ['e','t','a','o','i','n','s','h','r','d','l','c','u','m','w','f','g','y','p','b','v','k','j','x','q','z'];
        $clock = new Clock;
        while (count($letters)) {
            $clock->start();
            $results = $this->options->solveAll($letters);
            #printf("One iteration took %f\n", $clock->stop());
            $letters = array_keys($results);
        }
    }
}
