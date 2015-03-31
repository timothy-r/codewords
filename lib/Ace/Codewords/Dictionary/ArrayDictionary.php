<?php namespace Codewords\Dictionary;

use Codewords\DictionaryInterface;
use Codewords\Dictionary\Dictionary;

/**
* implements DictionaryInterface using an in memory array of words
*/
class ArrayDictionary extends Dictionary implements DictionaryInterface
{
    public function __construct(array $words)
    {
        $this->setWords($words);
    }

    /**
    *
    * @return array of matching words
    */
    public function find($pattern, $length)
    {
        return $this->lookup($pattern);
    }
}
