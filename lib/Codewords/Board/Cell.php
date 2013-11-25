<?php namespace Codewords\Board;

use Codewords\Error\InvalidCellNumber;

/**
* Maps number to a character
*/
class Cell
{
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

    public function __construct($number, $character = null)
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
}
