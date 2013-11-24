<?php namespace Codewords\Board;

use Codewords\Board\Cell;

/**
* Represents a Word, set of Cells
*/
class Word implements \Iterator
{
    /**
    * @var integer
    */
    protected $index = 0;

    /**
    * @var array
    */
    protected $cells;

    public function __construct(array $cells)
    {
        $this->cells = $cells;    
    }

    public function at($index)
    {
        if ($index >= 0 && $index < count($this->cells)){
            return $this->cells[$index];
        }
    }

    public function contains(Cell $other)
    {
        foreach($this->cells as $cell){
            if ($other->matches($cell)){
                return true;
            }
        }
        return false;
    }

    public function length()
    {
        return count($this->cells);
    }

    public function first()
    {
        return $this->cells[0];
    }

    public function last()
    {
        return $this->cells[$this->length()-1];
    }

    public function current()
    {
        return $this->cells[$this->index];
    }

    public function key()
    {
        return $this->index;
    }

    public function next()
    {
        $this->index++;
    }

    public function rewind()
    {
        $this->index = 0;
    }
    
    /**
    * Test if calling next() will make current() valid or not
    */
    public function valid()
    {
        return $this->index < count($this->cells);
    }

}
