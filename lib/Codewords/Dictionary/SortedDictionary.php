<?php namespace Codewords\Dictionary;

use Codewords\IDictionary;
use Codewords\Dictionary\Dictionary;

/**
* implements IDictionary using a data grouped by word length
*/
class SortedDictionary extends Dictionary implements IDictionary
{
    public function find($pattern)
    {
    }
}
