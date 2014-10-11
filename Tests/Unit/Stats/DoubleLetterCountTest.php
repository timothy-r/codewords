<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Board\Board;
use Codewords\Board\Cell;
use Codewords\Stats\DoubleLetterCount;
use Codewords\Test\UnitFixtureTrait;

/**
* @group unit
*/
class DoubleLetterCountTest extends PHPUnit_Framework_TestCase
{
    use UnitFixtureTrait;

    public function getDoubleLetterFixture()
    {
        return [
            [1, 0], 
            [2, 0], 
            [3, 1], 
            [4, 1], 
            [5, 0], 
            [6, 0], 
            [7, 0], 
            [8, 0], 
            [9, 0], 
        ];
    }
    
    /**
    * @dataProvider getDoubleLetterFixture
    */
    public function testGenerateCountsDoubleLettersForEachLetter($number, $expected)
    {
        $this->givenABoard();
        $this->givenACellCollection();

        $dlc = new DoubleLetterCount();

        $stats = $dlc->generate($this->board);
        $this->assertSame(26, count($stats));
        $this->assertSame($expected, $stats[$number]);
    }

    /**
    * @dataProvider getDoubleLetterFixture
    */
    public function testGenerateForCell($number, $expected)
    {
        $this->givenABoard();
        $this->givenACellCollection();

        $dlc = new DoubleLetterCount();
        $cell = new Cell($this->board, $number);

        $stats = $dlc->generateForCell($cell);
        $this->assertSame($expected, $stats);
    }
}

