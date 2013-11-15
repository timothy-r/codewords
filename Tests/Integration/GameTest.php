<?php
require_once(__DIR__ . '/IntegrationTest.php');
require_once(__DIR__. '/FixtureTrait.php');

use Codewords\Game;
use Codewords\FileDictionary;
use Codewords\HtmlTableBoardRenderer;

/**
* @group integration
*/
class GameTest extends IntegrationTest
{
    use FixtureTrait;

    /**
    * @dataProvider getValidGameData
    */
    public function testMakeGame($fixture)
    {
        $this->givenAFileDictionary();
        $this->givenAGame($fixture);

        $board = $this->game->getBoard();
        $this->assertInstanceOf('Codewords\Board', $board);

        $cells = $this->game->getCells();
        $this->assertInstanceOf('Codewords\CellCollection', $cells);
    }

    /**
    * @dataProvider getValidGameData
    */
    public function testRenderBoard($fixture, $expectation)
    {
        $this->givenAFileDictionary();
        $this->givenAGame($fixture);
        $expectation = $this->getFixture($expectation);
        $renderer = new HtmlTableBoardRenderer;
        $table = $renderer->render($this->game->getBoard());

        $this->assertSame($expectation, $table);
    }

    /**
    * @dataProvider getValidGameData
    */
    public function testGetFrequencies($fixture, $expectation)
    {
        $this->givenAFileDictionary();
        $this->givenAGame($fixture);
        $board = $this->game->getBoard();
        $frequencies = $board->getFrequencies();
        $this->assertSame(26, count($frequencies));
    }

    /**
    * @dataProvider getValidGameData
    */
    public function testGetDictionary($fixture)
    {
        $this->givenAFileDictionary();
        $this->givenAGame($fixture);

        $dictionary = $this->game->getDictionary();
        $this->assertInstanceOf('Codewords\IDictionary', $dictionary);
    }

    /**
    * @dataProvider getValidGameData
    */
    public function testGetStatsRepository($fixture)
    {
        $this->givenAFileDictionary();
        $this->givenAGame($fixture);

        $repo = $this->game->getStatsRepository();
        $this->assertInstanceOf('Codewords\Stats\StatsRepository', $repo);
    }
}
