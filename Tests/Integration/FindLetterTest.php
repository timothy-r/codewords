<?php
require_once(__DIR__ . '/IntegrationTest.php');
require_once(__DIR__. '/FixtureTrait.php');

use Codewords\Solver\FindLetter;
use FixtureTrait;

/**
* @group integration
*/
class FindLetterTest extends IntegrationTest
{
    use FixtureTrait;
    
    /**
    * @dataProvider getValidGameData
    */
    public function testSolveFindsOwnLetter($data)
    {
        $this->givenASortedDictionary();
        $this->givenAGame($data);
        $letter = 'A';
        $finder = new FindLetter($letter, []);
        $result = $finder->solve($this->game);
        $this->assertTrue(1 == count($result), "Expected only one result item");
    }
}
