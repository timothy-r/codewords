<?php
require_once(__DIR__ . '/../IntegrationTest.php');

use Codewords\Test\IntegrationFixtureTrait;
use Codewords\Test\FixtureTrait;
use Codewords\Solver\FinderFactory;

/**
* @group integration
*/
class FinderFactoryTest extends IntegrationTest
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
        $this->givenABoard('data-1.csv');
        $this->givenAStatsRepository();
        $factory = new FinderFactory($this->stats_repository, $this->dictionary);
        $finder = $factory->create($this->board, $letter);
        $this->assertInstanceOf('Codewords\IFinder', $finder);
    }
}
