<?php namespace Codewords;

abstract class Dictionary
{
    protected function lookup($words, $pattern)
    {
        $result = [];
        foreach($words as $word){
            if (preg_match('#'.$pattern.'#', $word)){
                $result []= trim($word);
            }
        }
        return $result;
    }
}
