<?php
require_once(__DIR__ . '/../IntegrationTest.php');
require_once(__DIR__. '/../FixtureTrait.php');

use Codewords\Solver\FinderFactory;

/**
* @group integration
*/
class FinderFactoryTest extends IntegrationTest
{
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
        $this->givenAGame('data-1.csv');
        $repo = new FinderFactory($this->game);
        $finder = $repo->create($letter);
        $this->assertInstanceOf('Codewords\IFinder', $finder);
    }
}
