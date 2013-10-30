<?php

require_once(__DIR__ . '/BaseTest.php');

use Codewords\Cell;

/**
* @group unit
*/
class CellTest extends BaseTest
{
    public function testCellHasANumber()
    {
        $cell = new Cell(1);
        $this->assertSame(1, $cell->getNumber());
    }

    public function testCanCellSetCharacter()
    {
        $char = 'Z';
        $cell = new Cell(1);
        $cell->setCharacter($char);
        $this->assertSame($char, $cell->getCharacter());
    }
}
