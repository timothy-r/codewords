<?php
require_once(__DIR__ . '/IntegrationTest.php');

use Codewords\Dictionary\SortedDictionary;

/**
* @group unit
*/
class SortedDictionaryTest extends IntegrationTest
{
    public function testFindReturnsAllMatchingWords()
    {
        $pattern = '^.a.$';
        $dictionary = new SortedDictionary(__DIR__.'/../../config/dict-2');
        $result = $dictionary->find($pattern);
        
        $this->assertTrue(is_array($result));
        $this->assertTrue(in_array('bat', $result));
        $this->assertTrue(in_array('mad', $result));
    }
}
