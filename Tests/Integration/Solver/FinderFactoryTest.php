<?php
require_once(__DIR__ . '/../IntegrationTest.php');
require_once(__DIR__. '/../FixtureTrait.php');

use Codewords\Solver\FinderFactory;

/**
* @group integration
*/
class FinderFactoryTest extends IntegrationTest
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
    public function testCreateForLetterReturnsIFinder($letter)
    {
        $repo = new FinderFactory;
        $finder = $repo->create($letter);
        $this->assertInstanceOf('Codewords\IFinder', $finder);
    }
}
