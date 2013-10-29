<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Board;
use Codewords\Cell;

class BoardTest extends BaseTest
{
    public function testCanAddCellToBoard()
    {
        $board = new Board;
        $cell = new Cell(1);
        $board->addCell($cell, 0, 0);
    }

    public function testCanGetCellToBoard()
    {
        $board = new Board;
        $cell = new Cell(1);
        $board->addCell($cell, 0, 0);
        $result = $board->getCell(0,0);
        $this->assertsame($cell, $result);
    }
}

