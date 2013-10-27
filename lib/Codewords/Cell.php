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

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function getNumber()
    {
    }

    public function setCharacter($char)
    {
    }

    public function getCharacter()
    {
    }
}
