<?php namespace Codewords\Dictionary;

use Codewords\DictionaryInterface;
use Codewords\Dictionary\Dictionary;

/**
* implements DictionaryInterface using a data from a unix dictionary format file
*/
class FileDictionary extends Dictionary implements DictionaryInterface
{
    /**
    * @var array of words
    */
    protected $words;

    /**
    * @var string
    */
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
    *
    * @return array of matching words
    */
    public function find($pattern, $length)
    {
        if (!$this->words){
            $this->words = file($this->file);
        }
        return $this->lookup($this->words, $pattern);
    }
}
