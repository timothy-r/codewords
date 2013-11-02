<?php namespace Codewords;

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

    public function __construct($number)
    {
        if (!is_numeric($number)){
            throw new InvalidCellNumber("$number is out of range, ({$this->min} - {$this->max})");
        }
        
        $number = (integer) $number;

        if ($number > $this->max || $number < $this->min){
            throw new InvalidCellNumber("$number is out of range, ({$this->min} - {$this->max})");
        }

        $this->number = $number;
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

    public function isNull()
    {
        return 0 === $this->number;
    }
}
