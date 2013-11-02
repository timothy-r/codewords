<?php namespace Codewords;

use Codewords\Cell;
use Codewords\Error\IllegalOperation;
use Codewords\Error\InvalidCellLocation;

/**
* Represents the grid of Cells
* Contains the Cells
* Allows access to rows, columns and cells
*/
class Board
{
    /**
    * @var array
    */
    protected $rows = [];
    
    /**
    * boards are square with width & height = length
    * @var integer
    */
    protected $length;

    public function __construct($length)
    {
        $this->length = $length;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function addCell(Cell $cell, $x, $y)
    {
        $this->validateLocation($x);
        $this->validateLocation($y);
        if (isset($this->rows[$y])){
            if (isset($this->rows[$y][$x])){
                throw new IllegalOperation("Cannot overwrite a Cell at ($x,$y)");
            }
        }

        $this->rows[$y][$x] = $cell;
    }

    public function getCell($x, $y)
    {
        $this->validateLocation($x);
        $this->validateLocation($y);

        $row = $this->rows[$y];
        return $row[$x]; 
    }

    protected function validateLocation($location)
    {
        if ($location < 0 || $location > $this->length) {
            throw new InvalidCellLocation;
        }
    }
}
