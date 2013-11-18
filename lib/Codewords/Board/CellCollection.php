<?php namespace Codewords\Board;

use Codewords\Board\Cell;
use Codewords\Error\InvalidCellLocation;

/**
* Produces and contains the Games Cells
*/
class CellCollection
{
    protected $cells = [];
 
    protected $length;

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
        for ($i = 1; $i <= $this->length; $i++) {
            $cell = $this->at($i);
            if (!$cell->isSolved()){
                $unsolved[]= $cell;
            }
        }
        return $unsolved;
    }
}
