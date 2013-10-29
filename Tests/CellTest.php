<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Cell;

class CellTest extends BaseTest
{
    public function testCellHasANumber()
    {
        $cell = new Cell(1);
        $this->assertSame(1, $cell->getNumber());
    }
}

