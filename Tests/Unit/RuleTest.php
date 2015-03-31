<?php

use Ace\Codewords\Test\UnitFixtureTrait;

/**
* @group unit
*/
abstract class RuleTest extends PHPUnit_Framework_TestCase
{
    use UnitFixtureTrait;
    
    protected $cell;

    public function setUp()
    {
        parent::setUp();
        $this->givenABoard();
        $this->givenAStatsRepository();
        $this->cell = $this->getMock('Ace\Codewords\Board\Cell', [], [$this->board, 1]);
    }

    protected function givenAStatObject($result)
    {
        $stat = $this->getMock('Ace\Codewords\GameStatsInterface', ['generate', 'generateForCell']);
        $stat->expects($this->any())
            ->method('generateForCell')
            ->will($this->returnValue($result));
        $this->stats_repository->expects($this->any())
            ->method('getStat')
            ->will($this->returnValue($stat));
    }
}
