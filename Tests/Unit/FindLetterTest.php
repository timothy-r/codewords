<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Solver\FindLetter;
use Codewords\Test\UnitFixtureTrait;
use Codewords\Test\IntegrationFixtureTrait;

/**
* @group integration
*/
class FindLetterTest extends BaseTest
{
    use UnitFixtureTrait;

    public function testSolveFindsOwnLetter()
    {
        $letter = 'A';
        $this->givenAMockDictionary();
        $this->givenACellCollection();
        // set one Cell to be A
        $this->cell_collection->at(1)->setCharacter($letter);
        $this->givenAMockBoard();

        $finder = new FindLetter($this->dictionary, $letter, []);
        $result = $finder->solve($this->board);
        $this->assertTrue(1 == count($result), "Expected only one result item");
        $this->assertSame(1, current($result)->getNumber());
    }

    public function testSolveFindsLetterWhenAllOthersAreSet()
    {
        $letter = 'Z';
        $this->givenAMockDictionary();
        $this->givenACellCollection();

        // set all Cells except 1 to be letters other than A
        for ($i = 1; $i < 26; $i++){
            // 66 = B
            $this->cell_collection->at($i)->setCharacter(chr($i+64));
        }
        $this->givenAMockBoard();

        $finder = new FindLetter($this->dictionary, $letter, []);
        $result = $finder->solve($this->board);
        $this->assertTrue(1 == count($result), "Expected only one result item");
        $this->assertSame(26, current($result)->getNumber());
    }

    public function testSolveReturnsEmptyIfAllRulesFail()
    {
        $letter = 'T';
        $this->givenAMockDictionary();
        $this->givenACellCollection();
        $this->givenAMockBoard();
        $rule = $this->getMockRule(false);
        $finder = new FindLetter($this->dictionary, $letter, [$rule]);
        $result = $finder->solve($this->board);
        $this->assertSame(0, count($result));
    }

    public function testSolveReturnsAllIfAllRulesPass()
    {
        $letter = 'T';
        $this->givenACellCollection();
        $this->givenAMockDictionary();

        // matches can be found for all the Cells in all the Words
        $this->dictionary->expects($this->any())
            ->method('find')
            ->will($this->returnValue(['matchingword']));

        $this->givenAMockBoard();
        $word = $this->getMockWord();
        $this->board->expects($this->any())
            ->method('getWordsContainingCell')
            ->will($this->returnValue([$word]));

        $rule = $this->getMockRule(true);
        $finder = new FindLetter($this->dictionary, $letter, [$rule]);
        $result = $finder->solve($this->board);
        $this->assertSame(26, count($result));
    }

    public function testSolveReturnsCellsThatMatchAllWords()
    {

    }

    protected function getMockRule($passes)
    {
        $rule = $this->getMock('Codewords\IRule', ['passes']);
        $rule->expects($this->any())
            ->method('passes')
            ->will($this->returnValue($passes));
        return $rule;
    }
}
