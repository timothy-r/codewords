<?php namespace Ace\Codewords\Board;

use Ace\Codewords\Board\Board;
use Ace\Codewords\Board\Cell;
use Ace\Codewords\Error\InvalidCellLocation;

/**
* Produces and contains the Games Cells
*/
class CellCollection implements \Iterator
{
    /**
    * @var \Ace\Codewords\Board\Board
    */
    protected $board;

    protected $cells = [];
 
    protected $length;

    protected $index = 1;

    public function __construct(Board $board, $length = 26)
    {
        $this->board = $board;
        $this->length = $length;
    }

    /**
    * @throws \Ace\Codewords\InvalidCellNumber
    * @return \Ace\Codewords\Cell
    */
    public function at($number)
    {
        $number = (integer)$number;

        if (!isset($this->cells[$number])){
            $this->cells[$number] = new Cell($this->board, $number);
        }
        return $this->cells[$number];
    }
    
    /**
    * @deprecated - this method is not in use
    */
    public function cellForCharacter($char)
    {
        foreach($this->cells as $cell) {
            if ($cell->getCharacter() === $char){
                return $cell;
            }
        }
        return null;
    }
    
    /**
    * @return array of Cells which are unsolved
    */
    public function getUnsolved()
    {
        $unsolved = [];
        // foreach($this) fails here, why?
        for($i = 1; $i <= $this->length; $i++){
            $cell = $this->at($i);
            if (!$cell->isSolved()){
                $unsolved[]= $cell;
            }
        }
        return $unsolved;
    }

    /**
    * @return array of Cells which are solved
    */
    public function getSolved()
    {
        $solved = [];
        foreach($this->cells as $cell){
            if ($cell->isSolved()){
                $solved[]= $cell;
            }
        }
        return $solved;
    }

    public function length()
    {
        return $this->length;
    }

    public function current()
    {
        return $this->at($this->index);
    }

    public function key()
    {
        return $this->index;
    }

    public function next()
    {
        $this->index++;
    }

    public function rewind()
    {
        $this->index = 1;
    }
    
    /**
    * Test if calling next() will make current() valid or not
    */
    public function valid()
    {
        return $this->index <= $this->length;
    }
}
