<?php

require_once(__DIR__ . '/../IntegrationTest.php');
require_once(__DIR__. '/../FixtureTrait.php');

use Codewords\Solver\FindI;

class FindITest extends IntegrationTest
{
    use FixtureTrait;

    public function getValidGameData()
    {
        return [
            ['data-1.csv',['1','2','3','4','5','6','7','8','9','10','11','12','13','15','16','17','19','20','21','22','23','24','25','26']],
            ['data-3.csv',['1','3','4','5','7','8','9','10','11','12','13','14','15','16','17','19','20','21','23','24','25','26']],
        ];
    }
    
    /**
    * @dataProvider getValidGameData
    */
    public function testSolveReturnsArrayOfCells($fixture, $expected)
    {
        $this->givenAFileDictionary();
        $this->givenAGame($fixture);

        $solver = new FindI($this->game);
        $results = $solver->solve();
        
        $this->assertTrue(is_array($results), "Expected solve() to return an array");
        $this->assertSame(count($expected), count($results), "Expected solve() to return ".count($expected)." results");
        foreach($results as $cell) {
            $this->assertIsCell($cell);
            $this->assertTrue(in_array($cell->getNumber(), $expected), "Didn't expect " . $cell->getNumber() . " to be a possible I");
        }
    }
}
