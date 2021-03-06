<?php

use Ace\Codewords\Test\IntegrationFixtureTrait;
use Ace\Codewords\Test\FixtureTrait;
use Ace\Codewords\Test\AssertionTrait;

use Ace\Codewords\Solver\FinderFactory;

class FindLetterIntegrationTest extends PHPUnit_Framework_TestCase
{
    use IntegrationFixtureTrait;
    use FixtureTrait;
    use AssertionTrait;

    public function getValidBoardData()
    {
        return [
            ['data-1.csv', 'i', [1,2,3,6,7,9,10,11,15,16,17,19,21,23], []], 
            ['data-3.csv', 'i', [3,4,5,7,9,12,13,26], [17 => 'n', 6 => 'p']],
            ['data-1.csv', 'q', [3,16], []], 
            ['data-3.csv', 'q', [12,25], [17 => 'n', 6 => 'p', 3 => 'i']],
            ['data-1.csv', 'u', [1,10,15,16,19], []],
            ['data-3.csv', 'u', [4,12,19,26], [17 => 'n', 6 => 'p', 3 => 'i']],
            ['data-3.csv', 'e', [12,13,15,26], [17 => 'n', 6 => 'p', 3 => 'i']],
        ];
    }

    /**
    * @dataProvider getValidBoardData
    */
    public function testSolveReturnsArrayOfPossibleCells($fixture, $letter, $expected, $solved)
    {
        $this->givenASortedDictionary();
        $this->givenACsvBoardReader();
        $this->givenABoardFactory();
        $this->givenABoard($fixture);
        $this->givenAStatsRepository();
        
        $cells = $this->board->getCells();
        foreach($solved as $number => $value){
            $cells->at($number)->setCharacter($value);
        }
        
        $factory = new FinderFactory($this->stats_repository, $this->dictionary);
        $solver = $factory->create($letter);
        $results = $solver->solve($this->board);

        $numbers = array_map(function($cell){ return $cell->getNumber();}, $results);
        // debug 
        #var_dump(implode(',', $numbers));

        $this->assertTrue(is_array($results), "Expected solve() to return an array");
        $this->assertSame(count($expected), count($results), "Expected solve() to return ".implode(',', $expected)." not " . implode(',',$numbers));
        foreach($results as $cell) {
            $this->assertIsCell($cell);
            $this->assertTrue(in_array($cell->getNumber(), $expected), "Didn't expect " . $cell->getNumber() . " to be a possible $letter");
        }
    }
}

