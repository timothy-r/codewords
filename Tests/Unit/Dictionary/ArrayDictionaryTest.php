<?php

use Ace\Codewords\Dictionary\ArrayDictionary;

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

    public function testWordsReturnsEmptyWhenNoWordsOfLengthExist()
    {
        $words = ['cat', 'mat', 'mouse'];
        $dictionary = new ArrayDictionary($words);
        $result = $dictionary->words(4);
        $this->assertTrue(is_array($result));
        $this->assertSame(0, count($result));
    }

    public function testWordsReturnsArrayOfWords()
    {
        $words = ['cat', 'mat', 'mouse'];
        $dictionary = new ArrayDictionary($words);
        $result = $dictionary->words(3);
        $this->assertTrue(is_array($result));
        $this->assertSame(2, count($result));
    }

    public function testLongestWordReturnsZeroWhenNoWordsSet()
    {
        $dictionary = new ArrayDictionary([]);
        $result = $dictionary->longestWord();
        $this->assertSame(0, $result);
    }

    public function testLongestWord()
    {
        $words = ['cat', 'mat', 'mouse'];
        $dictionary = new ArrayDictionary($words);
        $result = $dictionary->longestWord();
        $this->assertSame(5, $result);
    }
}
