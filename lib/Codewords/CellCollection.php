<?php namespace Codewords;

use Codewords\Cell;
use Codewords\Error\InvalidCellLocation;

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

    public function cellForCharacter($char)
    {
        foreach($this->cells as $cell) {
            if ($cell->getCharacter() === $char){
                return $cell;
            }
        }
        return null;
    }
}
