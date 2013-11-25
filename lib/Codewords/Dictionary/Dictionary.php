<?php namespace Codewords\Dictionary;

abstract class Dictionary
{
    protected function lookup($words, $pattern)
    {
        $result = [];
        $pattern = strtolower($pattern);
        foreach($words as $word){
            $word = trim($word);
            if (preg_match('#'.$pattern.'#', $word)){
                $result []= $word;
            }
        }
        return $result;
    }
}
