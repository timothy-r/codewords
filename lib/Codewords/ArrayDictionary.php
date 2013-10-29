<?php namespace Codewords;

use Codewords\IDictionary;

/**
* implements IDictionary using an in memory array of words
*/
class ArrayDictionary implements IDictionary
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
        $result = [];
        foreach($this->words as $word){
            if (preg_match('#'.$pattern.'#', $word)){
                $result []= $word;
            }
        }
        return $result;
    }
}
