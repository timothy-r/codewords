<?php

use Codewords\Test\IntegrationFixtureTrait;
use Codewords\Test\FixtureTrait;
use Codewords\BoardLoader;

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
        $this->assertInstanceOf('Codewords\Board\Board', $board);
    }
}
