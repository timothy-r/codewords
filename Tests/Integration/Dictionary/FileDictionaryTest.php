<?php

use Codewords\Dictionary\FileDictionary;

/**
* @group integration
*/
class FileDictionaryTest extends PHPUnit_Framework_TestCase
{
    public function testFindReturnsAllMatchingWords()
    {
        $pattern = '^.a.$';
        $dictionary = new FileDictionary(__DIR__.'/../../../config/words');
        $result = $dictionary->find($pattern, 3);

        $this->assertTrue(is_array($result));
        $this->assertTrue(in_array('Ian', $result));
        $this->assertTrue(in_array('lap', $result));
    }
}
