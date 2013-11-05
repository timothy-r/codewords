<?php namespace Codewords;

use Codewords\Cell;

/**
* Represents a Word, set of Cells
*/
class Word
{
    /**
    * @var array
    */
    protected $word;

    public function __construct(array $word)
    {
        $this->word = $word;    
    }

    public function at($index)
    {
        if ($index >= 0 && $index < count($this->word)){
            return $this->word[$index];
        }
    }

    public function contains(Cell $other)
    {
        foreach($this->word as $cell){
            if ($other->matches($cell)){
                return true;
            }
        }
        return false;
    }
}
