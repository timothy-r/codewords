<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Board;
use Codewords\Stats\FollowingLetterCount;
use Codewords\Test\UnitFixtureTrait;

class FollowingLetterCountTest extends BaseTest
{
    use UnitFixtureTrait;

    public function testGenerateCountsFollowingLettersInEachWord()
    {
        $this->givenABoard();
        $this->givenACellCollection();
        $this->givenAGame();

        $flc = new FollowingLetterCount();

        $stats = $flc->generate($this->game);
        $cells = $this->cell_collection; 
        $this->assertSameCells(['2' => $cells->at(2), '3' => $cells->at(3)], $stats[1]);
        $this->assertSameCells(['3' => $cells->at(3)], $stats[2]);
        $this->assertSameCells(['3' => $cells->at(3), '4' => $cells->at(4), '8' => $cells->at(8)], $stats[3]);
        $this->assertSameCells(['7' => $cells->at(7), '4' => $cells->at(4)], $stats[4]);
        $this->assertSameCells(['9' => $cells->at(9)], $stats[7]);
        $this->assertSameCells([], $stats[8]);
        $this->assertSameCells([], $stats[9]);
    }

    protected function assertSameCells(array $expected, array $actual)
    {
        foreach($expected as $key => $cell){
            $other = $actual[$key];
            $this->assertTrue($cell->matches($other), "Expected cell " . $cell->getNumber(). " got cell " . $other->getNumber());
        }
        $this->assertSame(count($expected), count($actual));
    }
}
