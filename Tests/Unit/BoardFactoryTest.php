<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Board;
use Codewords\Cell;
use Codewords\BoardFactory;
use Codewords\IBoardReader;

/**
* @group unit
*/
class BoardFactoryTest extends BaseTest
{
    protected $factory;

    protected $reader;

    protected $mock_cell;

    public function setUp()
    {
        $this->reader = $this->getMock('Codewords\IBoardReader', ['numberAt', 'length']);
        $collection = $this->getMock('Codewords\CellCollection', ['at']);
        $this->mock_cell  = $this->getMock('Codewords\Cell', [], [], '', false);
        $collection->expects($this->any())
            ->method('at')
            ->will($this->returnValue($this->mock_cell));
        $this->factory = new BoardFactory($this->reader, $collection);
    }

    public function testCreateReturnsABoard()
    {
        $product = $this->factory->create();
        $this->assertInstanceOf('Codewords\Board', $product);
    }

    public function testCreateAddsCellsToBoard()
    {
        $number = 19;
        $length = 15;
        $this->reader->expects($this->atLeastOnce())
            ->method('length')
            ->will($this->returnValue($length));
        
        $this->reader->expects($this->atLeastOnce())
            ->method('numberAt')
            ->will($this->returnValue($number));
        
        $product = $this->factory->create();
        
        for ($y = 0; $y <= $length; $y++) {
            for($x = 0; $x <= $length; $x++) {
                $cell = $product->getCell($x, $y);
                $this->assertSame($this->mock_cell, $cell);
            }
        }
    }
}
