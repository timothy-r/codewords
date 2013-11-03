<?php
require_once(__DIR__ . '/IntegrationTest.php');

use Codewords\Game;
use Codewords\FileDictionary;
use Codewords\HtmlTableBoardRenderer;

/**
* @group integration
*/
class GameTest extends IntegrationTest
{
    protected $dictionary;

    public function setUp()
    {
        parent::setUp();
        $words = file(__DIR__.'/../../config/words');
        $this->dictionary = new FileDictionary($words);
    }

    public function getValidGameData()
    {
        return [
            ['data-1.csv', 'data-1-expectation.html']
        ];
    }
    
    /**
    * @dataProvider getValidGameData
    */
    public function testMakeGame($fixture)
    {
        $game = new Game($this->getFixture($fixture), $this->dictionary);

        $board = $game->getBoard();
        $this->assertInstanceOf('Codewords\Board', $board);

        $cells = $game->getCells();
        $this->assertInstanceOf('Codewords\CellCollection', $cells);
    }

    /**
    * @dataProvider getValidGameData
    */
    public function testRenderBoard($fixture, $expectation)
    {
        $expectation = $this->getFixture($expectation);
        $game = new Game($this->getFixture($fixture), $this->dictionary);
        $renderer = new HtmlTableBoardRenderer;
        $table = $renderer->render($game->getBoard());

        $this->assertSame($expectation, $table);
    }

    /**
    * @dataProvider getValidGameData
    */
    public function testGetFrequencies($fixture, $expectation)
    {
        $game = new Game($this->getFixture($fixture), $this->dictionary);
        $board = $game->getBoard();
        $frequencies = $board->getFrequencies();
        $this->assertSame(26, count($frequencies));
    }

    /**
    * @dataProvider getValidGameData
    */
    public function testGetDictionary($fixture)
    {
        $game = new Game($this->getFixture($fixture), $this->dictionary);
        $dictionary = $game->getDictionary();
        $this->assertInstanceOf('Codewords\IDictionary', $dictionary);
    }
}
