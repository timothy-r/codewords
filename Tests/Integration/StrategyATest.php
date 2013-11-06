<?php
require_once(__DIR__ . '/IntegrationTest.php');
require_once(__DIR__. '/FixtureTrait.php');

use Codewords\StrategyA;
use Codewords\Game;
use Codewords\FileDictionary;

/**
* @group integration
*/
class StrategyATest extends IntegrationTest
{
    use FixtureTrait;

    public function getValidGameData()
    {
        return [
            ['data-1.csv', 'data-1-expectation.html']
        ];
    }

    /**
    * @dataProvider getValidGameData
    */
    public function testFindLetter($data)
    {
        return;

        $this->givenAFileDictionary();
        $this->givenAGame($data);
        // first three letters are solved
        $this->game->getCells()->at(13)->setCharacter('I');
        $this->game->getCells()->at(14)->setCharacter('L');
        $this->game->getCells()->at(24)->setCharacter('A');
        $strategy = new StrategyA($this->game);
        $letter = $strategy->nextLetter();

    }
}
