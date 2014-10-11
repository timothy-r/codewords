<?php namespace Codewords\Dictionary;

abstract class Dictionary
{
    /**
    * @var array of words
    */
    protected $words;
    
    protected function setWords($words)
    {
        $this->words = $words;
    }

    protected function lookup($pattern)
    {
        $result = [];
        $pattern = strtolower($pattern);
        foreach($this->words as $word){
            $word = trim($word);
            if (preg_match('#'.$pattern.'#', $word)){
                $result []= $word;
            }
        }
        return $result;
    }

    public function words($length)
    {
        $result = [];
        foreach($this->words as $word){
            if (strlen($word) == $length){
                $result []= $word;
            }
        }
        return $result;
    }
}
