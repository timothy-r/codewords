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
            ['data-1.csv', ['3']],
        ];
    }
    
    /**
    * @dataProvider getValidGameData
    */
    public function testSolveReturnsArrayOfCells($fixture, $expected)
    {
        $this->givenAFileDictionary();
        $this->givenAGame($fixture);
        
        $solver = new FindQ($this->game);
        $results = $solver->solve();

        $this->assertTrue(is_array($results), "Expected solve() to return an array");
        $this->assertSame(count($expected), count($results), "Expected solve() to return ".count($expected)." results");
        foreach($results as $cell) {
            $this->assertInstanceOf('Codewords\Cell', $cell);
            $this->assertTrue(in_array($cell->getNumber(), $expected), "Didn't expect " . $cell->getNumber() . " to be a possible Q");
        }
    }
}
