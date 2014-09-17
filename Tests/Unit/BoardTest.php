<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Board\Board;
use Codewords\Board\Cell;
use Codewords\Board\Word;
use Codewords\Test\UnitFixtureTrait;

/**
* @group unit
*/
class BoardTest extends BaseTest
{
    use UnitFixtureTrait;

   public function setUp()
    {
        parent::setUp();
        $this->givenAMockBoard();
    }

    public function testCanAddCellToBoard()
    {
        $board = new Board(12);
        $cell = $this->getCell(1);
        $board->addCell(1, 0, 0);
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
        $board = new Board(12);
        $cell = $board->getCells()->at(1);
        //$cell = new Cell($board, 1); 
        //$cell = $this->getCell(1);
        $board->addCell(1, $x, $y);
        $result = $board->getCell($x, $y);
        $this->assertEquals($cell, $result);
    }
   
    public function getInvalidCellLocations()
    {
        return [
            [-2, 0],
            [40, 2],
            [3, -4],
            [10, 33],
        ];
    }

    /**
    * @dataProvider getInvalidCellLocations
    * @expectedException Codewords\Error\InvalidCellLocation
    */
    public function testMustAddCellAtValidLocation($x, $y)
    {
        $board = new Board(12);
        $cell = $this->getCell(1);
        $board->addCell(1, $x, $y);
    }

    /**
    * @dataProvider getInvalidCellLocations
    * @expectedException Codewords\Error\InvalidCellLocation
    */
    public function testMustGetCellAtValidLocation($x, $y)
    {
        $board = new Board(12);
        $board->getCell($x, $y);
    }
    
    /**
    * @expectedException Codewords\Error\IllegalOperation
    */
    public function testCannotOverwriteACell()
    {
        $x = $y = 1;
        $board = new Board(12);
        $cell = $this->getCell(1);
        $board->addCell(1, $x, $y);
        $board->addCell(1, $x, $y);
    }

    public function testCanGetWords()
    {
        $board = $this->generateTestBoard();
        $words = $board->getWords();
        $this->assertTrue(is_array($words));
        $this->assertWord('ANTI', $words[0]);
        $this->assertWord('WI', $words[1]);
        $this->assertWord('A**E', $words[2]);
        $this->assertWord('TOW', $words[3]);
        $this->assertWord('IN', $words[4]);
    }

    public function testGetFrequencies()
    {
        $board = $this->generateTestBoard();
        $frequencies = $board->getFrequencies();

        $this->assertTrue(is_array($frequencies));
        $this->assertSame(26, count($frequencies));
        $this->assertSame(1, $frequencies[1]);
        $this->assertSame(2, $frequencies[2]);
        $this->assertSame(1, $frequencies[3]);
        $this->assertSame(2, $frequencies[4]);
        $this->assertSame(1, $frequencies[5]);
        $this->assertSame(1, $frequencies[6]);
        $this->assertSame(1, $frequencies[7]);
        $this->assertSame(1, $frequencies[8]);
        $this->assertSame(1, $frequencies[9]);
    }

    public function getWordCountsForNumber()
    {
        return [
            [1, 2],
            [2, 2],
            [3, 2],
            [4, 3],
            [5, 1],
            [6, 1],
        ];
    }

    /**
    * @dataProvider getWordCountsForNumber
    */
    public function testCanGetWordsContainingCell($number, $count)
    {
        $board = $this->generateTestBoard();
        $cell = $this->getCell($number);
        $words = $board->getWordsContainingCell($cell);
        $this->assertSame($count, count($words));
        foreach($words as $word) {
            $this->assertTrue($word->contains($cell));
        }
    }

    protected function generateTestBoard()
    {
        $board = new Board(4);
        // ANTI
        // *.O.
        // *.WI
        // E..N
        $this->addCell($board, 1, 'A', 0, 0);
        $this->addCell($board, 2, 'N', 1, 0);
        $this->addCell($board, 3, 'T', 2, 0);
        $this->addCell($board, 4, 'I', 3, 0);

        $this->addCell($board, 9, '',  0, 1);
        $this->addCell($board, 0, '',  1, 1);
        $this->addCell($board, 5, 'O', 2, 1);
        $this->addCell($board, 0, '',  3, 1);

        $this->addCell($board, 6, '', 0, 2);
        $this->addCell($board, 0, '',  1, 2);
        $this->addCell($board, 7, 'W', 2, 2);
        $this->addCell($board, 4, 'I', 3, 2);

        $this->addCell($board, 8, 'E',  0, 3);
        $this->addCell($board, 0, '',   1, 3);
        $this->addCell($board, 0, '',   2, 3);
        $this->addCell($board, 2, 'N',  3, 3);
        return $board;
    }

    protected function assertWord($text, Word $word)
    {
        for($i = 0; $i < $word->length(); $i++){
            $char = substr($text, $i, 1);
            $cell = $word->at($i);
            if ('*' == $char){
                $this->assertNull( $cell->getCharacter());
            } else  {
                $char = substr($text, $i, 1);
                $this->assertSame($char, $cell->getCharacter(), "Expected '$char' got '" . $cell->getCharacter() . "'");
            }
        }
    }
}
