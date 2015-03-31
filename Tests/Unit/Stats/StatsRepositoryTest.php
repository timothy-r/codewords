<?php

use Ace\Codewords\Stats\StatsRepository;
use Ace\Codewords\Error\UnknownStatName;

/**
* @group unit
*/
class StatsRepositoryTest extends PHPUnit_Framework_TestCase
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
        $this->assertInstanceOf('Ace\Codewords\GameStatsInterface', $stat);
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
    * @expectedException Ace\Codewords\Error\UnknownStatName
    */
    public function testGetInvalidStatThrowsException($name)
    {
        $repo = new StatsRepository;
        $repo->getStat($name);
    }
}
