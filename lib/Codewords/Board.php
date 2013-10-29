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

    public function __construct()
    {
        $this->rows = [];
        for ($y = 0; $y < 13; $y++) {
            $row = [];
            for($x = 0; $x < 13; $x++) {
                $row[$x] = null;
            }
            $this->rows []= $row;
        }
    }

    public function addCell(Cell $cell, $x, $y)
    {
        $row = &$this->rows[$y];
        $row[$x] = $cell;
    }

    public function getCell($x, $y)
    {
        $row = $this->rows[$y];
        return $row[$x]; 
    }
}
