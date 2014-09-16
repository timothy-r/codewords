<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Board\Board;
use Codewords\Board\Cell;
use Codewords\Stats\FirstLetterCount;
use Codewords\Test\UnitFixtureTrait;

/**
* @group unit
*/
class FirstLetterCountTest extends BaseTest
{
    use UnitFixtureTrait;

    /**
    * @dataProvider getFirstLetterFixture
    */
    public function testGenerateCountsFirstLettersInEachWord($number, $expected)
    {
        $this->givenABoard();
        $this->givenACellCollection();

        $flc = new FirstLetterCount();

        $stats = $flc->generate($this->board);
        $this->assertSame(26, count($stats));
        $this->assertSame($expected, $stats[$number]);
    }

    public function getFirstLetterFixture()
    {
        return [
            [1, 2], 
            [2, 0], 
            [3, 1], 
            [4, 1], 
            [5, 0], 
            [6, 0], 
            [7, 1], 
            [8, 0], 
            [9, 0], 
        ];
    }

    /**
    * @dataProvider getFirstLetterFixture
    */
    public function testGenerateForCell($number, $expected)
    {
        $this->givenABoard();
        $this->givenACellCollection();
        
        $cell = new Cell($number);
        $flc = new FirstLetterCount();

        $stats = $flc->generateForCell($this->board, $cell);

        $this->assertSame($expected, $stats);
    }
}
