<?php namespace Codewords\Dictionary;

abstract class Dictionary
{
    protected function lookup($words, $pattern)
    {
        $result = [];
        //var_dump(__METHOD__. ' ' . $pattern);
        $pattern = strtolower($pattern);
        foreach($words as $word){
            $word = trim($word);
            if (preg_match('#'.$pattern.'#', $word)){
                //print "$word\n";
                $result []= $word;
            }
        }
        return $result;
    }
}
