<?php namespace Codewords\Dictionary;

use Codewords\DictionaryInterface;
use Codewords\Dictionary\Dictionary;

/**
* implements DictionaryInterface using a data grouped by word length
*/
class SortedDictionary extends Dictionary implements DictionaryInterface
{
    /**
    * @var array of Word data
    */
    protected $dict;

    /**
    * @var string
    */
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function find($pattern, $length)
    {
        if (!is_array($this->dict)){
            $this->dict = require($this->file);
        }

        // assume that $pattern contains ^ and $ chars
        $words = $this->dict[$length];
        preg_match_all('#'.$pattern.'#m', $words, $matches);
        return $matches[0];
    }
}
