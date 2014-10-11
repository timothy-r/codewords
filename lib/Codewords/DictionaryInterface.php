<?php namespace Codewords;

/**
* Dictionary interface provides access to query a dictionary using a pattern
*/
interface DictionaryInterface
{
    public function find($pattern, $length);

    /**
    * @return array or words of length $length
    */
    public function words($length);
}
