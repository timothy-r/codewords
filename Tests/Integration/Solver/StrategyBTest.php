<?php

require_once(__DIR__ . '/../IntegrationTest.php');

use Codewords\Test\IntegrationFixtureTrait;
use Codewords\Solver\StrategyB;
use Codewords\Board\Cell;
use Codewords\Solver\FinderFactory;
use Codewords\Solver\CellOptions;

class StrategyBIntegrationTest extends IntegrationTest
{
    use IntegrationFixtureTrait;

    public function testSolve()
    {
        $fixture = 'data-4.csv';
        $this->givenASortedDictionary();
        $this->givenAGame($fixture);
        $finder_factory = new FinderFactory($this->game);
        $cell_options = new CellOptions($this->game, $finder_factory);
        $strategy = new StrategyB($cell_options);

        $result = $strategy->solve($this->game);
        $cells = $this->game->getCells();
        $this->assertCellCharacter($cells->at(1), 'a');
        $this->assertCellCharacter($cells->at(2), 'b');
        $this->assertCellCharacter($cells->at(3), 'r');
        $this->assertCellCharacter($cells->at(4), 'o');
        $this->assertCellCharacter($cells->at(5), 'l');
        $this->assertCellCharacter($cells->at(6), 'e');
        $this->assertCellCharacter($cells->at(7), 't');
        $this->assertCellCharacter($cells->at(8), 'k');
        $this->assertCellCharacter($cells->at(9), 'f');
        $this->assertCellCharacter($cells->at(10), 'q');
        $this->assertCellCharacter($cells->at(11), 'i');
        $this->assertCellCharacter($cells->at(12), 'y');
        $this->assertCellCharacter($cells->at(13), 'v');
        $this->assertCellCharacter($cells->at(14), 'p');
        $this->assertCellCharacter($cells->at(15), 'g');
        $this->assertCellCharacter($cells->at(16), 'd');
        $this->assertCellCharacter($cells->at(17), 'x');
        $this->assertCellCharacter($cells->at(18), 'n');
        $this->assertCellCharacter($cells->at(19), 'z');
        $this->assertCellCharacter($cells->at(20), 'j');
        $this->assertCellCharacter($cells->at(21), 's');
        $this->assertCellCharacter($cells->at(22), 'h');
        $this->assertCellCharacter($cells->at(23), 'w');
        $this->assertCellCharacter($cells->at(24), 'u');
        $this->assertCellCharacter($cells->at(25), 'c');
        $this->assertCellCharacter($cells->at(26), 'm');
    }

    protected function assertCellCharacter(Cell $cell, $character)
    {
        $this->assertSame($character, $cell->getCharacter());
    }
}
