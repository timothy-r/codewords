<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Board;
use Codewords\Stats\LetterCount;
use Codewords\Test\UnitFixtureTrait;

class LetterCountTest extends BaseTest
{
    use UnitFixtureTrait;

    public function testGenerateCountsLettersInBoard()
    {
        $this->givenABoard();
        $this->givenAGame();
        $letter_count = new LetterCount();

        $stats = $letter_count->generate($this->game);

        $this->assertSame(1, $stats[1]);
        $this->assertSame(1, $stats[2]);
        $this->assertSame(2, $stats[3]);
        $this->assertSame(2, $stats[4]);
        $this->assertSame(1, $stats[5]);
        $this->assertSame(1, $stats[6]);
        $this->assertSame(1, $stats[7]);
        $this->assertSame(1, $stats[7]);
        $this->assertSame(1, $stats[9]);
    }
}

