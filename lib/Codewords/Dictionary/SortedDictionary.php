<?php namespace Codewords\Dictionary;

use Codewords\IDictionary;
use Codewords\Dictionary\Dictionary;

/**
* implements IDictionary using a data grouped by word length
*/
class SortedDictionary extends Dictionary implements IDictionary
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

    public function find($pattern)
    {
        if (!$this->dict){
            $this->dict = require_once($this->file);
        }

        // assume that $pattern contains ^ and $ chars
        $len = strlen($pattern) - 2;
        $words = $this->dict[$len];
        preg_match_all('#'.$pattern.'#m', $words, $matches);
        return $matches[0];
    }
}
