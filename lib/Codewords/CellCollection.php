<?php namespace Codewords;

use Codewords\Cell;

class CellCollection
{
    protected $cells = [];

    /**
    *
    * @return Codewords\Cell
    */
    public function cell($number)
    {
        if (!isset($this->cells[$number])){
            $this->cells[$number] = new Cell($number);
        }
        return $this->cells[$number];
    }
}
