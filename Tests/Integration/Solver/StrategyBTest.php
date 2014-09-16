<?php

require_once(__DIR__ . '/../IntegrationTest.php');

use Codewords\Test\IntegrationFixtureTrait;
use Codewords\Test\FixtureTrait;
use Codewords\Solver\StrategyB;
use Codewords\Board\Cell;
use Codewords\Solver\FinderFactory;
use Codewords\Solver\CellOptions;

/**
* @group slow
* @group integration
*/
class StrategyBIntegrationTest extends IntegrationTest
{
    use IntegrationFixtureTrait;
    use FixtureTrait;

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
        $cell_options = new CellOptions($this->board, $finder_factory);
        $strategy = new StrategyB($cell_options);

        $result = $strategy->solve();
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

    /**
    * @dataProvider getInvalidFixtures
    * @expectedException Codewords\Error\InvalidBoardData
    */
    public function testSolveDetectsInvalidBoards($fixture)
    {
        $this->givenASortedDictionary();
        $this->givenAGame($fixture);
    }
}
