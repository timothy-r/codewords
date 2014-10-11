<?php

use Codewords\Test\IntegrationFixtureTrait;
use Codewords\Test\FixtureTrait;
use Codewords\Solver\FinderFactory;

/**
* @group integration
*/
class FinderFactoryTest extends PHPUnit_Framework_TestCase
{
    use IntegrationFixtureTrait;
    use FixtureTrait;

    public function getLetterFixtures()
    {
        return [
            ['U'],
        ];
    }
    
    /**
    * @dataProvider getLetterFixtures
    */
    public function testCreateForLetterReturnsIFinder($letter)
    {
        $this->givenASortedDictionary();
        //$this->givenABoard('data-1.csv');
        $this->givenAStatsRepository();
        $factory = new FinderFactory($this->stats_repository, $this->dictionary);
        $finder = $factory->create($letter);
        $this->assertInstanceOf('Codewords\IFinder', $finder);
    }
}
