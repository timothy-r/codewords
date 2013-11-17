<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Board;
use Codewords\Cell;
use Codewords\Stats\FirstLetterCount;
use Codewords\Test\UnitFixtureTrait;

class FirstLetterCountTest extends BaseTest
{
    use UnitFixtureTrait;

    public function testGenerateCountsFirstLettersInEachWord()
    {
        $this->givenABoard();
        $this->givenACellCollection();
        $this->givenAGame();

        $flc = new FirstLetterCount();

        $stats = $flc->generate($this->game);
        $this->assertSame(26, count($stats));

        $this->assertSame(2, $stats[1]);
        $this->assertSame(0, $stats[2]);
        $this->assertSame(1, $stats[3]);
        $this->assertSame(1, $stats[4]);
        $this->assertSame(0, $stats[5]);
        $this->assertSame(0, $stats[6]);
        $this->assertSame(1, $stats[7]);
        $this->assertSame(0, $stats[8]);
        $this->assertSame(0, $stats[9]);
    }

    public function getCellFixture()
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
    * @dataProvider getCellFixture
    */
    public function testGenerateForCell($number, $expected)
    {
        $this->givenABoard();
        $this->givenACellCollection();
        $this->givenAGame();
        
        $cell = new Cell($number);
        $flc = new FirstLetterCount();

        $stats = $flc->generateForCell($this->game, $cell);

        $this->assertSame($expected, $stats);
    }
}

