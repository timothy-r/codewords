<?php

require_once(__DIR__ . '/../IntegrationTest.php');
require_once(__DIR__. '/../FixtureTrait.php');

use Codewords\Solver\FindQ;

class FindQTest extends IntegrationTest
{
    use FixtureTrait;

    public function getValidGameData()
    {
        return [
            ['data-1.csv']
        ];
    }
    
    /**
    * @dataProvider getValidGameData
    */
    public function testSolveReturnsArrayOfCells($fixture)
    {
        $this->givenAFileDictionary();
        $this->givenAGame($fixture);
        
        $solver = new FindQ($this->game);
        $results = $solver->solve();

        $this->assertTrue(is_array($results), "Expected solve() to return an array");
        $this->assertTrue(count($results) > 0, "Expected solve() to return 1+ results");
    }
}
