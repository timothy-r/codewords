<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Board\Word;
use Codewords\Board\Cell;

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

    public function testWordLength()
    {
        $cells = [new Cell(1), new Cell(2)];
        $word = new Word($cells);
        $this->assertSame(2, $word->length());
    }

    public function testWordFirst()
    {
        $cells = [new Cell(1), new Cell(2)];
        $word = new Word($cells);
        $this->assertSame($cells[0], $word->first());
    }

    public function testWordLast()
    {
        $cells = [new Cell(1), new Cell(2)];
        $word = new Word($cells);
        $this->assertSame($cells[1], $word->last());
    }

    public function testCanIterateOverWord()
    {
        $cells = [new Cell(1), new Cell(2), new Cell(3)];
        $word = new Word($cells);
        foreach($word as $index =>$cell){
            $this->assertSame($index+1, $cell->getNumber());
        }
    }
    
    public function getInvalidIndexes()
    {
        return [
            [-1],
            [10000000]
        ];
    }
    
    /**
    * @dataProvider getInvalidIndexes
    */
    public function testCellAtReturnsNullForInvalidIndexes($index)
    {
        $cells = [new Cell(1), new Cell(2)];
        $word = new Word($cells);
        $result = $word->at($index);
        $this->assertNull($result);
    }
}
