<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Test\UnitFixtureTrait;

/**
* @group unit
*/
abstract class RuleTest extends BaseTest
{
    use UnitFixtureTrait;
    
    protected $cell;

    public function setUp()
    {
        parent::setUp();
        $this->givenABoard();
        $this->givenAStatsRepository();
        $this->cell = $this->getMock('Codewords\Board\Cell', [], [$this->board, 1]);
    }

    protected function givenAStatObject($result)
    {
        $stat = $this->getMock('Codewords\IGameStats', ['generate', 'generateForCell']);
        $stat->expects($this->any())
            ->method('generateForCell')
            ->will($this->returnValue($result));
        $this->stats_repository->expects($this->any())
            ->method('getStat')
            ->will($this->returnValue($stat));
    }
}
