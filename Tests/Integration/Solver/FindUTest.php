<?php

require_once(__DIR__ . '/../IntegrationTest.php');
require_once(__DIR__. '/../FixtureTrait.php');

use Codewords\Solver\FindU;

class FindUTest extends IntegrationTest
{
    use FixtureTrait;

    public function getValidGameData()
    {
        return [
            ['data-1.csv', ['1', '3', '10', '15', '16', '19', '23', '26']],
            ['data-3.csv', ['1', '4', '5', '7', '9', '12', '13', '14', '16', '19', '20', '25', '26']],
        ];
    }
    
    /**
    * @dataProvider getValidGameData
    */
    public function testSolveReturnsArrayOfCells($fixture, $expected)
    {
        $this->givenAFileDictionary();
        $this->givenAGame($fixture);
        
        $solver = new FindU($this->game);
        $results = $solver->solve();
        
        $this->assertTrue(is_array($results), "Expected solve() to return an array");
        $this->assertSame(count($expected), count($results), "Expected solve() to return ".count($expected)." results");
        foreach($results as $cell) {
            $this->assertInstanceOf('Codewords\Cell', $cell);
            $this->assertTrue(in_array($cell->getNumber(), $expected), "Didn't expect " . $cell->getNumber() . " to be a possible U");
        }
    }
}
