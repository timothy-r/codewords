<?php namespace Codewords\Dictionary;

use Codewords\IDictionary;
use Codewords\Dictionary\Dictionary;

/**
* implements IDictionary using an in memory array of words
*/
class ArrayDictionary extends Dictionary implements IDictionary
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
    public function find($pattern, $length)
    {
        return $this->lookup($this->words, $pattern);
    }
}
