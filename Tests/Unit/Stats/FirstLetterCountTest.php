<?php

use Ace\Codewords\Board\Board;
use Ace\Codewords\Board\Cell;
use Ace\Codewords\Stats\FirstLetterCount;
use Ace\Codewords\Test\UnitFixtureTrait;

/**
* @group unit
*/
class FirstLetterCountTest extends PHPUnit_Framework_TestCase
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
        
        $cell = new Cell($this->board, $number);
        $flc = new FirstLetterCount();

        $stats = $flc->generateForCell($cell);

        $this->assertSame($expected, $stats);
    }
}
