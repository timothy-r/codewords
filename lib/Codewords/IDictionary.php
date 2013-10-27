<?php namespace Codewords;

/**
* Dictionary interface is the way to test if patterns match words
*/
interface IDictionary
{
    public function find($pattern);
}
