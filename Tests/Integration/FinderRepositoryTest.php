<?php
require_once(__DIR__ . '/IntegrationTest.php');
require_once(__DIR__. '/FixtureTrait.php');

use Codewords\Solver\FinderRepository;

/**
* @group integration
*/
class FinderRepositoryTest extends IntegrationTest
{
    public function getLetterFixtures()
    {
        return [
            ['U'],
        ];
    }
    
    /**
    * @dataProvider getLetterFixtures
    */
    public function testGetFinderForLetter($letter)
    {
        $repo = new FinderRepository;
        $finder = $repo->getFinder($letter);
        $this->assertInstanceOf('Codewords\IFinder', $finder);
    }
}
