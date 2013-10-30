<?php namespace Codewords;

use Codewords\Cell;
use Codewords\InvalidCellLocation;

class CellCollection
{
    protected $cells = [];
    
    protected $max_cells = 26;

    /**
    *
    * @return Codewords\Cell
    */
    public function at($number)
    {
        if ($number > $this->max_cells || $number < 1){
            throw new InvalidCellLocation;
        }

        if (!isset($this->cells[$number])){
            $this->cells[$number] = new Cell($number);
        }
        return $this->cells[$number];
    }
}
