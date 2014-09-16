<?php namespace Codewords\Test;

use Codewords\Board\Board;
use Codewords\Board\Cell;
use Codewords\Board\CellCollection;
use Codewords\Board\Word;

trait UnitFixtureTrait
{
    protected $board;

    protected $cell_collection;

    protected $stats_repository;

    protected $dictionary;

    protected function givenACellCollection()
    {
        $this->cell_collection = new CellCollection;
    }

    protected function givenAStatsRepository()
    {
        $this->stats_repository = $this->getMock('Codewords\Stats\StatsRepository', ['getStat']);
    }

    protected function givenAMockBoard()
    {
        $this->board = $this->getMock('Codewords\Board\Board', ['getWordsContainingCell', 'getCells'], [], '', false);
        $this->board->expects($this->any())
            ->method('getCells')
            ->will($this->returnValue($this->cell_collection));
    }

    protected function getMockWord()
    {
        return $this->getMockBuilder('Codewords\Board\Word')->disableOriginalConstructor()->getMock();
    }

    protected function givenAMockDictionary()
    {
        $this->dictionary =  $this->getMockBuilder('Codewords\IDictionary')->disableOriginalConstructor()->getMock();
    }

    protected function givenABoard()
    {
        $this->board = new Board(4);
        // ALSO
        // S.O.
        // S.OI
        // E..N
        $this->addCell($this->board, 1, 'A', 0, 0); 
        $this->addCell($this->board, 2, 'L', 1, 0); 
        $this->addCell($this->board, 3, 'S', 2, 0); 
        $this->addCell($this->board, 4, 'O', 3, 0); 

        $this->addCell($this->board, 3, 'S', 0, 1); 
        $this->addCell($this->board, 0, '',  1, 1); 
        $this->addCell($this->board, 4, 'O', 2, 1); 
        $this->addCell($this->board, 0, '',  3, 1); 

        $this->addCell($this->board, 3, 'S', 0, 2); 
        $this->addCell($this->board, 0, '',  1, 2); 
        $this->addCell($this->board, 4, 'O', 2, 2); 
        $this->addCell($this->board, 7, 'I', 3, 2); 

        $this->addCell($this->board, 8, 'E', 0, 3); 
        $this->addCell($this->board, 0, '',  1, 3); 
        $this->addCell($this->board, 0, '',  2, 3); 
        $this->addCell($this->board, 9, 'N', 3, 3); 
        
        return $this->board;
    }

    protected function addCell(Board $board, $number, $char, $x, $y)
    {
        $board->addCell($number, $x, $y);
        $cell = $board->getCells()->at($number);
        if ($char){
            $cell->setCharacter($char);
        }
        return $number;
    }
}
