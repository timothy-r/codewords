<?php namespace Codewords;

class Dictionary
{
    /**
    * @var array of words
    */
    protected $words;

    public function __construct(array $words)
    {
        $this->words = $words;
    }

    /**
    *
    * @return array of matching words
    */
    public function find($pattern)
    {
    }
}
