<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Stats\StatsRepository;
use Codewords\Error\UnknownStatName;

/**
* @group unit
*/
class StatsRepositoryTest extends BaseTest
{
    public function getStatNames()
    {
        return [
            ['LastLetter'],
            ['DoubleLetter'],
            ['FirstLetter'],
            ['FollowingLetter'],
            ['Letter'],
        ];
    }

    /**
    * @dataProvider getStatNames
    */
    public function testGetStat($name)
    {
        $repo = new StatsRepository;
        $stat = $repo->getStat($name);
        $this->assertInstanceOf('Codewords\IGameStats', $stat);
    }

    public function getInvalidStatNames()
    {
        return [
            [null],
            ['Invalid'],
        ];
    }

    /**
    * @dataProvider getInvalidStatNames
    * @expectedException Codewords\Error\UnknownStatName
    */
    public function testGetInvalidStatThrowsException($name)
    {
        $repo = new StatsRepository;
        $stat = $repo->getStat($name);
    }
}
