<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Solver\NotDoubleRule;
use Codewords\Test\UnitFixtureTrait;

/**
* @group unit
*/
class NotDoubleTest extends BaseTest
{
    use UnitFixtureTrait;

    public function testCellThatHasNoDoublesPassesRule()
    {
        $result = [];
        $this->givenAStatsRepository();
        $stat = $this->getMock('Codewords\IGameStats', ['generate', 'generateForCell']);
        $stat->expects($this->any())
            ->method('generateForCell')
            ->will($this->returnValue($result));
        $this->stats_repository->expects($this->any())
            ->method('getStat')
            ->will($this->returnValue($stat));
        
        $this->givenAGame();

        $cell = $this->getMock('Codewords\Board\Cell', [], [1]);
        $rule = new NotDoubleRule($this->game);
        $passes = $rule->passes($cell);
        $this->assertTrue($passes, 'Expected rule to pass');
    }

    public function testCellThatHasDoublesFailsRule()
    {
        $result = [2,4,5];
        $this->givenAStatsRepository();
        $stat = $this->getMock('Codewords\IGameStats', ['generate', 'generateForCell']);
        $stat->expects($this->any())
            ->method('generateForCell')
            ->will($this->returnValue($result));
        $this->stats_repository->expects($this->any())
            ->method('getStat')
            ->will($this->returnValue($stat));
        
        $this->givenAGame();

        $cell = $this->getMock('Codewords\Board\Cell', [], [1]);
        $rule = new NotDoubleRule($this->game);
        $passes = $rule->passes($cell);
        $this->assertFalse($passes, 'Expected rule to fail');
    }
}
