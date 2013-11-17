<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Board;
use Codewords\Stats\LastLetterCount;
use Codewords\Test\UnitFixtureTrait;

class LastLetterCountTest extends BaseTest
{
    use UnitFixtureTrait;

    public function testGenerateCountsLastLettersInEachWord()
    {
        $this->givenABoard();
        $this->givenACellCollection();
        $this->givenAGame();

        $flc = new LastLetterCount();

        $stats = $flc->generate($this->game);
        
        $this->assertSame(26, count($stats));
        $this->assertSame(0, $stats[1]);
        $this->assertSame(0, $stats[2]);
        $this->assertSame(0, $stats[3]);
        $this->assertSame(2, $stats[4]);
        $this->assertSame(0, $stats[5]);
        $this->assertSame(0, $stats[6]);
        $this->assertSame(1, $stats[7]);
        $this->assertSame(1, $stats[8]);
        $this->assertSame(1, $stats[9]);
    }
}

