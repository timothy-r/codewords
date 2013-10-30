<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Board;
use Codewords\Cell;
use Codewords\BoardDirector;
use Codewords\IBoardReader;

class BoardDirectorTest extends BaseTest
{
    public function testCreateReturnsABoard()
    {
        $reader = $this->getMock('Codewords\IBoardReader', ['numberAt']);
        $director = new BoardDirector($reader);
        $product = $director->create();
        $this->assertInstanceOf('Codewords\Board', $product);
    }
}
