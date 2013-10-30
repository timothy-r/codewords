<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Board;
use Codewords\Cell;

/**
* @group unit
*/
class BoardTest extends BaseTest
{
    public function testCanAddCellToBoard()
    {
        $board = new Board;
        $cell = new Cell(1);
        $board->addCell($cell, 0, 0);
    }
    
    public function getValidCellLocations()
    {
        return [
            [0, 0],
            [12, 0],
            [6, 6],
            [0, 12],
            [12, 12]
        ];
    }

    /**
    * @dataProvider getValidCellLocations
    */
    public function testCanGetCellFromBoard($x, $y)
    {
        $board = new Board;
        $cell = new Cell(1);
        $board->addCell($cell, $x, $y);
        $result = $board->getCell($x, $y);
        $this->assertsame($cell, $result);
    }
   
    public function getInvalidCellLocations()
    {
        return [
            [-2, 0],
            [13, 2],
            [40, 2],
            [3, -4],
            [10, 13],
            [10, 33],
        ];
    }

    /**
    * @dataProvider getInvalidCellLocations
    * @expectedException Codewords\InvalidCellLocation
    */
    public function testMustAddCellAtValidLocation($x, $y)
    {
        $board = new Board;
        $cell = new Cell(1);
        $board->addCell($cell, $x, $y);
    }

    /**
    * @dataProvider getInvalidCellLocations
    * @expectedException Codewords\InvalidCellLocation
    */
    public function testMustGetCellAtValidLocation($x, $y)
    {
        $board = new Board;
        $board->getCell($x, $y);
    }
}
