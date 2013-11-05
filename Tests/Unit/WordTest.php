<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Word;
use Codewords\Cell;

/**
* @group unit
*/
class WordTest extends BaseTest
{
    public function testCanAccessCellsInWord()
    {
        $cells = [new Cell(1), new Cell(2)];
        $word = new Word($cells);
        $cell = $word->at(0);
        $this->assertTrue($cell->matches($cells[0]));
        $cell = $word->at(1);
        $this->assertTrue($cell->matches($cells[1]));
    }

    public function testWordContainsCells()
    {
        $cells = [new Cell(1), new Cell(2)];
        $word = new Word($cells);
        $this->assertTrue($word->contains($cells[0]));
        $this->assertTrue($word->contains($cells[1]));
        $this->assertFalse($word->contains(new Cell(3)));
    }
}
