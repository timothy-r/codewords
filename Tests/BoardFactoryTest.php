<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Board;
use Codewords\Cell;
use Codewords\BoardFactory;
use Codewords\IBoardReader;

class BoardFactoryTest extends BaseTest
{
    public function testCreateReturnsABoard()
    {
        $reader = $this->getMock('Codewords\IBoardReader', ['numberAt']);
        $factory = new BoardFactory($reader);
        $product = $factory->create();
        $this->assertInstanceOf('Codewords\Board', $product);
    }
}
