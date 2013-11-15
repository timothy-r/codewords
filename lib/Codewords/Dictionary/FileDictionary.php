<?php namespace Codewords\Dictionary;

use Codewords\IDictionary;
use Codewords\Dictionary\Dictionary;

/**
* implements IDictionary using a data from a unix dictionary format file
*/
class FileDictionary extends Dictionary implements IDictionary
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
    public function find($pattern)
    {
        if (!$this->words){
            $this->words = file($this->file);
        }
        return $this->lookup($this->words, $pattern);
    }
}
