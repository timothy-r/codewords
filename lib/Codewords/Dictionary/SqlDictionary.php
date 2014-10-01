<?php namespace Codewords\Dictionary;

use Codewords\DictionaryInterface;

/**
* implements DictionaryInterface using an sql database as storage 
*/
class SqlDictionary implements DictionaryInterface
{
    public function __construct()
    {
    }

    /**
    * @return array of matching words
    */
    public function find($pattern, $length)
    {
    }
}
