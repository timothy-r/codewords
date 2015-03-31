<?php

use Ace\Codewords\Test\IntegrationFixtureTrait;
use Ace\Codewords\Test\FixtureTrait;
use Ace\Codewords\Test\AssertionTrait;

use Ace\Codewords\Solver\StrategyB;
use Ace\Codewords\Board\Cell;
use Ace\Codewords\Solver\FinderFactory;

/**
* @group slow
* @group integration
*/
class StrategyBIntegrationTest extends PHPUnit_Framework_TestCase
{
    use IntegrationFixtureTrait;
    use FixtureTrait;
    use AssertionTrait;

    public function getFixtures()
    {
        return [
            ['data-4.csv', 'abroletkfqiyvpgdxnzjshwucm'],
            ['data-5.csv', 'sicgoazbyhxqljwmntkurpvfe'],
        ];
    }

    /**
    * @dataProvider getFixtures
    */
    public function testSolve($fixture, $soln)
    {
        $this->givenASortedDictionary();
        $this->givenACsvBoardReader();
        $this->givenABoardFactory();
        $this->givenABoard($fixture);
        $this->givenAStatsRepository();
        $finder_factory = new FinderFactory($this->stats_repository, $this->dictionary);
        $strategy = new StrategyB($finder_factory);

        $result = $strategy->solve($this->board);
        $cells = $this->board->getCells();
        for($i = 1; $i < 26; $i++){
            $letter = substr($soln, $i-1, 1);
            $this->assertCellCharacter($cells->at($i), $letter);
        }
    }

    protected function assertCellCharacter(Cell $cell, $character)
    {
        $this->assertSame($character, $cell->getCharacter());
    }

    public function getInvalidFixtures()
    {
        return [
            ['data-9.csv', 'abroletkfqiyvpgdxnzjshwucm'],
        ];
    }
}
