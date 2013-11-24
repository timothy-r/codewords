<?php namespace Codewords\Board;

use Codewords\Board\Cell;
use Codewords\Error\InvalidCellLocation;

/**
* Produces and contains the Games Cells
* @todo implement iterable
*/
class CellCollection implements \Iterator
{
    protected $cells = [];
 
    protected $length;

    protected $index = 1;

    public function __construct($length = 26)
    {
        $this->length = $length;
    }

    /**
    * @throws Codewords\InvalidCellNumber
    * @return Codewords\Cell
    */
    public function at($number)
    {
        $number = (integer)$number;

        if (!isset($this->cells[$number])){
            $this->cells[$number] = new Cell($number);
        }
        return $this->cells[$number];
    }

    public function cellForCharacter($char)
    {
        foreach($this as $cell) {
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
        foreach($this as $cell){
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
        foreach($this as $cell){
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
