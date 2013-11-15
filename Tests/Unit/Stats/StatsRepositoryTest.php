<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Stats\StatsRepository;

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

}
