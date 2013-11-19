<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Solver\FindLetter;
use Codewords\Test\UnitFixtureTrait;

/**
* @group integration
*/
class FindLetterTest extends BaseTest
{
    use UnitFixtureTrait;
    
    public function testSolveFindsOwnLetter()
    {
        $letter = 'A';
        $this->givenACellCollection();
        // set one Cell to be A
        $this->cell_collection->at(1)->setCharacter($letter);
        $this->givenAGame();

        $finder = new FindLetter($letter, []);
        $result = $finder->solve($this->game);
        $this->assertTrue(1 == count($result), "Expected only one result item");
    }
}
