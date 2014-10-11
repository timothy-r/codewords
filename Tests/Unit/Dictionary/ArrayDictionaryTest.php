<?php

use Codewords\Dictionary\ArrayDictionary;

/**
* @group unit
*/
class ArrayDictionaryTest extends PHPUnit_Framework_TestCase
{
    public function testFindReturnsAllMatchingWords()
    {
        $pattern = '^.a.$';
        $words = ['cat', 'mat', 'mouse'];
        $dictionary = new ArrayDictionary($words);
        $result = $dictionary->find($pattern, 3);

        $this->assertTrue(is_array($result));
        $this->assertSame(2, count($result));
        $this->assertTrue(in_array('cat', $result));
        $this->assertTrue(in_array('mat', $result));
    }
}
