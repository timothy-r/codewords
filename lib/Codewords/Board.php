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

        return $this->rows[$y][$x];
    }
    
    /**
    * @return array of arrays of Cells
    */
    public function getWords()
    {
        $words = [];
        // iterate along each row first
        $word = [];
        foreach($this->rows as $row){
            foreach($row as $cell){
                $this->addCellToWord($cell, $word, $words);
            }
            // end of line
            if (count($word) > 0){
                $words []= $word;
            }
            $word = [];
        }

        // now add vertical words
        for ($x = 0; $x < $this->length; $x++){
            for ($y = 0; $y < $this->length; $y++){
                $cell = $this->rows[$y][$x];
                $this->addCellToWord($cell, $word, $words);
            }
            // end of line
            if (count($word) > 0){
                $words []= $word;
            }
            $word = [];
        }
        return $words;
    }
    
    protected function addCellToWord(Cell $cell, array &$word, array &$words){
        if ($cell->isNull()){
            if (count($word) > 0){
                $words []= $word;
            }
            $word = [];
        } else {
            $word []= $cell;
        }
        //return $word;
    }

    protected function validateLocation($location)
    {
            if ($location < 0 || $location > $this->length) {
                    throw new InvalidCellLocation;
            }
    }
}
