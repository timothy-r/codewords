<?php namespace Codewords;

class Word
{
    protected $word;

    public function __construct($word)
    {
        $this->word = $word;    
    }

    public function letter($index)
    {
        if ($index >= 0 && $index <strlen($this->word)){
        }
    }

}
