<?php namespace Codewords;

use Codewords\Cell;

/**
* Represents the grid of 13 x 13 Cells
* Contains the Cells
* Allows access to rows, columns and cells
*/
class Board
{
    /**
    * @var array
    */
    protected $rows;
    
    /**
    * boards are square with width & height = length
    * @var integer
    */
    protected $length = 12;

    public function __construct()
    {
        $this->rows = [];
        for ($y = 0; $y <= $this->length; $y++) {
            $row = [];
            for($x = 0; $x <= $this->length; $x++) {
                $row[$x] = null;
            }
            $this->rows []= $row;
        }
    }

    public function addCell(Cell $cell, $x, $y)
    {
        $this->validateLocation($x);
        $this->validateLocation($y);

        $row = &$this->rows[$y];
        $row[$x] = $cell;
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
