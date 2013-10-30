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

    public function testCreateAddsCellsToBoard()
    {
        $number = 19;
        $length = 12;
        $reader = $this->getMock('Codewords\IBoardReader', ['numberAt']);
        $reader->expects($this->atLeastOnce())
            ->method('numberAt')
            ->will($this->returnValue($number));

        $factory = new BoardFactory($reader);
        $product = $factory->create();
        
        for ($y = 0; $y <= $length; $y++) {
            for($x = 0; $x <= $length; $x++) {
                $cell = $product->getCell($x, $y);
                $this->assertInstanceOf('Codewords\Cell', $cell);
                $this->assertSame($number, $cell->getNumber());
            }
        }
    }
}
