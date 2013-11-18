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
        $this->givenAGame();

        $flc = new LastLetterCount();

        $stats = $flc->generate($this->game);
        
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
        $this->givenAGame();

        $flc = new LastLetterCount();
        
        $cell = new Cell($number);
        $stats = $flc->generateForCell($this->game, $cell);
        $this->assertSame($expected, $stats);
    }
}

