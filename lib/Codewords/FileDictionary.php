<?php namespace Codewords;

use Codewords\IDictionary;

/**
* implements IDictionary using a data from a unix dictionary format file
*/
class FileDictionary implements IDictionary
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

        $result = [];
        foreach($this->words as $word){
            if (preg_match('#'.$pattern.'#', $word)){
                $result []= trim($word);
            }
        }
        return $result;
    }
}
