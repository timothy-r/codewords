<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Board;
use Codewords\Stats\DoubleLetterCount;
use Codewords\Test\UnitFixtureTrait;

class DoubleLetterCountTest extends BaseTest
{
    use UnitFixtureTrait;

    public function testGenerateCountsDoubleLettersForEachLetter()
    {
        $this->givenABoard();
        $this->givenACellCollection();
        $this->givenAGame();

        $flc = new DoubleLetterCount();

        $stats = $flc->generate($this->game);

        $this->assertSame(0, $stats[1]);
        $this->assertSame(0, $stats[2]);
        $this->assertSame(1, $stats[3]);
        $this->assertSame(1, $stats[4]);
        $this->assertSame(0, $stats[5]);
        $this->assertSame(0, $stats[6]);
        $this->assertSame(0, $stats[7]);
        $this->assertSame(0, $stats[8]);
        $this->assertSame(0, $stats[9]);
    }
}

