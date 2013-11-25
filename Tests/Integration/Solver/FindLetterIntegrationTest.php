<?php

require_once(__DIR__ . '/../IntegrationTest.php');
require_once(__DIR__. '/../FixtureTrait.php');

use Codewords\Solver\FinderFactory;

class FindLetterIntegrationTest extends IntegrationTest
{
    use FixtureTrait;

    public function getValidGameData()
    {
        return [
            ['data-1.csv', 'I', [1,2,3,6,7,9,10,11,15,16,17,19,21,23], []], 
            ['data-3.csv', 'I', [4,5,7,9,12,13,16,26], [17 => 'n', 6 => 'p']],
            ['data-1.csv', 'Q', [3,16,19], []], 
            ['data-3.csv', 'Q', [12,25,26], [17 => 'n', 6 => 'p']],
        ];
    }
    
    /**
    * @dataProvider getValidGameData
    */
    public function testSolveReturnsArrayOfPossibleCells($fixture, $letter, $expected, $solved)
    {
        $this->givenASortedDictionary();
        $this->givenAGame($fixture);
        
        $cells = $this->game->getCells();
        foreach($solved as $number => $value){
            $cells->at($number)->setCharacter($value);
        }
        
        $factory = new FinderFactory;
        $solver = $factory->create($letter);
        $results = $solver->solve($this->game);

        // debug 
        $numbers = array_map(function($cell){ return $cell->getNumber();}, $results);
        var_dump(implode(',', $numbers));

        $this->assertTrue(is_array($results), "Expected solve() to return an array");
        $this->assertSame(count($expected), count($results), "Expected solve() to return ".count($expected)." results");
        foreach($results as $cell) {
            $this->assertIsCell($cell);
            $this->assertTrue(in_array($cell->getNumber(), $expected), "Didn't expect " . $cell->getNumber() . " to be a possible $letter");
        }
    }
}
