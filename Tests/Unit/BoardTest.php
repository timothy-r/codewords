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
        $board = new Board(12);
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
        $board = new Board(12);
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
    * @expectedException Codewords\Error\InvalidCellLocation
    */
    public function testMustAddCellAtValidLocation($x, $y)
    {
        $board = new Board(12);
        $cell = new Cell(1);
        $board->addCell($cell, $x, $y);
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
        $cell = new Cell(1);
        $board->addCell($cell, $x, $y);
        $board->addCell($cell, $x, $y);
    }

    public function testCanGetWords()
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

        $this->addCell($board, 4, '',  0, 1);
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

        $words = $board->getWords();
        //print_r($words);die;
        $this->assertTrue(is_array($words));
        $this->assertWord('ANTI', $words[0]);
        $this->assertWord('WI', $words[1]);
        $this->assertWord('A**E', $words[2]);
        //$this->assertWord('ANTI', $words[0]);
        //$this->assertWord('ANTI', $words[0]);

        #$this->assertSame('ANTI', $words[0]);
        #$this->assertSame('WI', $words[1]);
        #$this->assertSame('A**E', $words[2]);
        #$this->assertSame('TOW', $words[3]);
        #$this->assertSame('IN', $words[4]);
    }
    
    protected function assertWord($text, $cells)
    {
        for($i = 0; $i < count($cells); $i++){
            $this->assertSame(substr($text, $i, 1), $cells[$i]->getCharacter());
        }

    }
    protected function addCell($board, $number, $char, $x, $y)
    {
        $c = new Cell($number);
        $c->setCharacter($char);
        $board->addCell($c, $x, $y);
        return $c;
    }
}
