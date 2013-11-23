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
        $this->assertSame(1, current($result)->getNumber());
    }

    public function testSolveFindsLetterWhenAllOthersAreSet()
    {
        $letter = 'Z';
        $this->givenACellCollection();

        // set all Cells except 1 to be letters other than A
        for ($i = 1; $i < 26; $i++){
            // 66 = B
            $this->cell_collection->at($i)->setCharacter(chr($i+64));
        }
        $this->givenAGame();

        $finder = new FindLetter($letter, []);
        $result = $finder->solve($this->game);
        $this->assertTrue(1 == count($result), "Expected only one result item");
        $this->assertSame(26, current($result)->getNumber());
    }
}
