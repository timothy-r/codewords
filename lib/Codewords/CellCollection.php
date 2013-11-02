<?php namespace Codewords;

use Codewords\Cell;
use Codewords\InvalidCellLocation;

/**
* Produces and contains the Games Cells
*/
class CellCollection
{
    protected $cells = [];
   
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
}
