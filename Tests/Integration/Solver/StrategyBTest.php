<?php

use Codewords\Test\IntegrationFixtureTrait;
use Codewords\Test\FixtureTrait;
use Codewords\Test\AssertionTrait;

use Codewords\Solver\StrategyB;
use Codewords\Board\Cell;
use Codewords\Solver\FinderFactory;

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
