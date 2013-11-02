<?php namespace Codewords;

use Codewords\Cell;
use Codewords\InvalidCellLocation;

class CellCollection
{
    protected $cells = [];
   
    protected $min = 1;
    protected $max = 26;

    /**
    * @throws Codewords\InvalidCellLocation
    * @return Codewords\Cell
    */
    public function at($number)
    {
        if ($number > $this->max || $number < $this->min){
            throw new InvalidCellLocation("$number is out of range, ({$this->min} - {$this->max})");
        }

        if (!isset($this->cells[$number])){
            $this->cells[$number] = new Cell($number);
        }
        return $this->cells[$number];
    }
}
