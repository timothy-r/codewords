<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Board;
use Codewords\Cell;
use Codewords\Stats\DoubleLetterCount;
use Codewords\Test\UnitFixtureTrait;

class DoubleLetterCountTest extends BaseTest
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
        $this->givenAGame();

        $flc = new DoubleLetterCount();

        $stats = $flc->generate($this->game);
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
        $this->givenAGame();

        $flc = new DoubleLetterCount();
        $cell = new Cell($number);

        $stats = $flc->generateForCell($this->game, $cell);
        $this->assertSame($expected, $stats);
    }
}

