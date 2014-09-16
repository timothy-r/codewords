<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Board\Board;
use Codewords\Board\Cell;
use Codewords\Stats\LastLetterCount;
use Codewords\Test\UnitFixtureTrait;

/**
* @group unit
*/
class LastLetterCountTest extends BaseTest
{
    use UnitFixtureTrait;

    /**
    * @dataProvider getLastLetterFixture
    */
    public function testGenerateCountsLastLettersInEachWord($number, $expected)
    {
        $this->givenABoard();
        $this->givenACellCollection();

        $llc = new LastLetterCount();

        $stats = $llc->generate($this->board);
        
        $this->assertSame(26, count($stats));
        $this->assertSame($expected, $stats[$number]);
    }
    
    public function getLastLetterFixture()
    {
        return [
            [1, 0],
            [2, 0],
            [3, 0],
            [4, 2],
            [5, 0],
            [6, 0],
            [7, 1],
            [8, 1],
            [9, 1],
        ];
    }

    /**
    * @dataProvider getLastLetterFixture
    */
    public function testGenerateForCell($number, $expected)
    {
        $this->givenABoard();
        $this->givenACellCollection();

        $llc = new LastLetterCount();
        
        $cell = new Cell($number);
        $stats = $llc->generateForCell($this->board, $cell);
        $this->assertSame($expected, $stats);
    }
}

