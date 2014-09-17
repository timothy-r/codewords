<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Test\UnitFixtureTrait;
use Codewords\Board\Word;
use Codewords\Board\Cell;

/**
* @group unit
*/
class WordTest extends BaseTest
{
    use UnitFixtureTrait;

    public function setUp()
    {
        parent::setUp();
        $this->givenAMockBoard();
    }

    public function testCanAccessCellsInWord()
    {
        $cells = [$this->getCell(1), $this->getCell(2)];
        $word = new Word($cells);
        $cell = $word->at(0);
        $this->assertTrue($cell->matches($cells[0]));
        $cell = $word->at(1);
        $this->assertTrue($cell->matches($cells[1]));
    }

    public function testWordContainsCells()
    {
        $cells = [$this->getCell(1), $this->getCell(2)];
        $word = new Word($cells);
        $this->assertTrue($word->contains($cells[0]));
        $this->assertTrue($word->contains($cells[1]));
        $this->assertFalse($word->contains($this->getCell(3)));
    }

    public function testWordLength()
    {
        $cells = [$this->getCell(1), $this->getCell(2)];
        $word = new Word($cells);
        $this->assertSame(2, $word->length());
    }

    public function testWordFirst()
    {
        $cells = [$this->getCell(1), $this->getCell(2)];
        $word = new Word($cells);
        $this->assertSame($cells[0], $word->first());
    }

    public function testWordLast()
    {
        $cells = [$this->getCell(1), $this->getCell(2)];
        $word = new Word($cells);
        $this->assertSame($cells[1], $word->last());
    }

    public function testCanIterateOverWord()
    {
        $cells = [$this->getCell(1), $this->getCell(2), $this->getCell(3)];
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
        $cells = [$this->getCell(1), $this->getCell(2)];
        $word = new Word($cells);
        $result = $word->at($index);
        $this->assertNull($result);
    }
}
