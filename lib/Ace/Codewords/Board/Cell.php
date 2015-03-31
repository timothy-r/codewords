<?php namespace Ace\Codewords\Board;

use Ace\Codewords\Board\Board;
use Ace\Codewords\Error\InvalidCellNumber;

/**
* Maps number to a character
*/
class Cell
{
    /**
    * @var Ace\Codewords\Board\Board
    */
    protected $board;

    /**
    * @var integer
    */
    protected $number;

    /**
    * @var string - a single character
    */
    protected $character;

    protected $min = 0;

    protected $max = 26;

    public function __construct(Board $board, $number, $character = null)
    {
        if (!is_numeric($number)){
            throw new InvalidCellNumber("$number is out of range, ({$this->min} - {$this->max})");
        }
        
        $number = (integer) $number;

        if ($number > $this->max || $number < $this->min){
            throw new InvalidCellNumber("$number is out of range, ({$this->min} - {$this->max})");
        }

        $this->number = $number;
        if (!is_null($character)){
            $this->setCharacter($character);
        }

        $this->board = $board;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setCharacter($char)
    {
        $this->character = $char;
    }

    public function getCharacter()
    {
        return $this->character;
    }

    /**
    * @return boolean
    */
    public function isNull()
    {
        return 0 === $this->number;
    }
    
    /**
    * @return boolean
    */
    public function matches(Cell $other)
    {
        return $other->getNumber() === $this->number;
    }

    /**
    * @return boolean
    */
    public function isSolved()
    {
        return !is_null($this->character);
    }
    
    /**
    * Returns the words that contain this Cell
    * @return array
    */
    public function getWords()
    {
        return $this->board->getWordsContainingCell($this);    
    }

    public function getBoard()
    {
        return $this->board;
    }
}
