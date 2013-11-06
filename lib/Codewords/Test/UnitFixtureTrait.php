<?php namespace Codewords\Test;

use Codewords\Board;
use Codewords\Cell;
use Codewords\CellCollection;
use Codewords\Word;

trait UnitFixtureTrait
{
    protected $game;

    protected $board;

    protected $cell_collection;

    protected function givenACellCollection()
    {
        $this->cell_collection = new CellCollection;
    }

    protected function givenAGame()
    {
        $this->game = $this->getMock('Codewords\Game', ['getBoard', 'getCells'], [], '', false);
        $this->game->expects($this->any())
            ->method('getBoard')
            ->will($this->returnValue($this->board));
        $this->game->expects($this->any())
            ->method('getCells')
            ->will($this->returnValue($this->cell_collection));
    }

    public function givenABoard()
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
        $this->addCell($this->board, 5, 'O', 2, 2); 
        $this->addCell($this->board, 7, 'I', 3, 2); 

        $this->addCell($this->board, 8, 'E', 0, 3); 
        $this->addCell($this->board, 0, '',  1, 3); 
        $this->addCell($this->board, 0, '',  2, 3); 
        $this->addCell($this->board, 9, 'N', 3, 3); 
        
        return $this->board;
    }

    protected function addCell(Board $board, $number, $char, $x, $y)
    {
        $c = new Cell($number);
        $c->setCharacter($char);
        $board->addCell($c, $x, $y);
        return $c;
    }
}
