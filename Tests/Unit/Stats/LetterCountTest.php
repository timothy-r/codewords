<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Board;
use Codewords\Stats\LetterCount;
use Codewords\Test\UnitFixtureTrait;

/**
* @group unit
*/
class LetterCountTest extends PHPUnit_Framework_TestCase
{
    use UnitFixtureTrait;

    public function getLetterCountFixture()
    {
        return [
            [1, 2], 
            [2, 1], 
            [3, 4], 
            [4, 4], 
            [7, 2], 
            [8, 1], 
            [9, 1], 
        ];
    }
    
    /**
    * @dataProvider getLetterCountFixture
    */
    public function testGenerateCountsLettersInBoard($number, $expected)
    {
        $this->givenABoard();
        $this->givenACellCollection();
        $letter_count = new LetterCount();

        $stats = $letter_count->generate($this->board);

        $this->assertSame(26, count($stats));
        $this->assertSame($expected, $stats[$number]);
        /*
        $this->assertSame(1, $stats[2]);
        $this->assertSame(3, $stats[3]);
        $this->assertSame(3, $stats[4]);
        $this->assertSame(0, $stats[5]);
        $this->assertSame(0, $stats[6]);
        $this->assertSame(1, $stats[7]);
        $this->assertSame(1, $stats[7]);
        $this->assertSame(1, $stats[9]);
        */
    }
}

