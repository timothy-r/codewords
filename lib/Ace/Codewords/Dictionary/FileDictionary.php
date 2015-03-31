<?php namespace Ace\Codewords\Dictionary;

use Ace\Codewords\DictionaryInterface;
use Ace\Codewords\Dictionary\Dictionary;

/**
* implements DictionaryInterface using a data from a unix dictionary format file
*/
class FileDictionary extends Dictionary implements DictionaryInterface
{
    /**
    * @var string
    */
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
    * @return array of matching words
    */
    public function find($pattern, $length)
    {
        $this->loadWords();
        return $this->lookup($pattern);
    }

    public function words($length)
    {
        $this->loadWords();
        return parent::words($length);
    }

    public function longestWord()
    {
        $this->loadWords();
        return parent::longestWord();
    }

    protected function loadWords()
    {
        if (!$this->words){
            $this->setWords(file($this->file));
        }
    }
}
