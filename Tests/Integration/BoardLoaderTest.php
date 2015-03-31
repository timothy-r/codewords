<?php

use Ace\Codewords\Test\IntegrationFixtureTrait;
use Ace\Codewords\Test\FixtureTrait;
use Ace\Codewords\BoardLoader;

/**
* @group integration
*/
class BoardLoaderTest extends PHPUnit_Framework_TestCase
{
    use IntegrationFixtureTrait;
    use FixtureTrait;

    /**
    * @dataProvider getValidBoardData
    */
    public function testLoadBoard($data)
    {
        $this->givenACsvBoardReader();
        $this->givenABoardFactory();
        $loader = new BoardLoader($this->board_reader, $this->board_factory);
        $fixture = $this->getFixture($data);
        $board = $loader->load($fixture);
        $this->assertInstanceOf('Ace\Codewords\Board\Board', $board);
    }
}
