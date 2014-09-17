<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Board\Board;
use Codewords\Board\Cell;
use Codewords\Stats\FollowingLetterCount;
use Codewords\Test\UnitFixtureTrait;

/**
* @group unit
*/
class FollowingLetterCountTest extends BaseTest
{
    use UnitFixtureTrait;

    public function getFollowingLetterFixture()
    {
        return [
            [1, [2,3]], 
            [2, [3]], 
            [3, [3,4,8]], 
            [4, [7, 4]], 
            [5, []], 
            [6, []], 
            [7, [9]], 
            [8, []], 
            [9, []], 
        ];
    }
    
    /**
    * @dataProvider getFollowingLetterFixture
    */
    public function testGenerateCountsFollowingLettersInEachWord($number, $expected)
    {
        $this->givenABoard();
        $this->givenACellCollection();

        $flc = new FollowingLetterCount();

        $stats = $flc->generate($this->board);

        $this->assertSame(26, count($stats));
        $this->assertSameCells($expected, $stats[$number]);
    }
    
    /**
    * @dataProvider getFollowingLetterFixture
    */
    public function testGenerateForCell($number, $expected)
    {
        $this->givenABoard();
        $this->givenACellCollection();

        $flc = new FollowingLetterCount();
        $cell = new Cell($this->board, $number);

        $stats = $flc->generateForCell($this->board, $cell);
        $this->assertSameCells($expected, $stats);
    }

    protected function assertSameCells(array $expected, array $actual)
    {
        foreach($expected as $key){
            $other = $actual[$key];
            $cell = $this->cell_collection->at($key);
            $this->assertTrue($cell->matches($other), "Expected cell " . $cell->getNumber(). " got cell " . $other->getNumber());
        }
        $this->assertSame(count($expected), count($actual));
    }
}
