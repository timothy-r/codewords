<?php namespace Codewords\Board;

use Codewords\Board\Cell;
use Codewords\Board\Word;
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

    /**
    */
    protected $words;

    protected $words_for_cell = [];

    public function __construct($length)
    {
        $this->length = $length;
    }

    public function getLength()
    {
        return $this->length;
    }

    /**
    * @deprecated use LetterCount class to do this
    *
    * access Cell frequencies
    * @return array
    */
    public function getFrequencies()
    {
        $frequencies = array_map(function($i){ return 0;}, range(1,27));
        unset($frequencies[0]);

        foreach($this->rows as $row){
            foreach($row as $cell){
                if (!$cell->isNull()){
                    $frequencies[$cell->getNumber()]++; 
                }
            }
        }

        return $frequencies; 
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
    * @todo refactor into a separate class
    * walk over the board and builds an array of Words
    * use a BoardIterator - Vertical or Horizontal 
    *
    * @return array of Word instances
    */
    public function getWords()
    {
        if ($this->words){
            return $this->words;
        }

        $this->words = [];

        // iterate along each row first
        $word = [];
        foreach($this->rows as $row){
            foreach($row as $cell){
                $this->addCellToWord($cell, $word, $this->words);
            }
            // end of line
            if (count($word) > 1){
                $this->words []= new Word($word);
            }
            $word = [];
        }

        // add vertical words
        for ($x = 0; $x < $this->length; $x++){
            for ($y = 0; $y < $this->length; $y++){
                $cell = $this->rows[$y][$x];
                $this->addCellToWord($cell, $word, $this->words);
            }
            // end of line
            if (count($word) > 1){
                $this->words []= new Word($word);
            }
            $word = [];
        }
        return $this->words;
    }
    
    /**
    * @return array of Words that contain $cell
    */
    public function getWordsContainingCell(Cell $cell)
    {
        if (isset($this->words_for_cell[$cell->getNumber()])){
            return $this->words_for_cell[$cell->getNumber()];
        }

        $words = [];
        $all_words = $this->getWords();

        foreach ($all_words as $word){
            if ($word->contains($cell)){
                $words []= $word;
            }
        }
        
        $this->words_for_cell[$cell->getNumber()] = $words;
        return $words;
    }

    protected function addCellToWord(Cell $cell, array &$word, array &$words)
    {
        if ($cell->isNull()){
            if (count($word) > 1){
                $words []= new Word($word);
            }
            $word = [];
        } else {
            $word []= $cell;
        }
    }

    protected function validateLocation($location)
    {
        if ($location < 0 || $location > $this->length) {
            throw new InvalidCellLocation;
        }
    }
}
