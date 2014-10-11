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
        $dictionary = new FileDictionary(__DIR__.'/../../fixtures/words');
        $result = $dictionary->find($pattern, 3);

        $this->assertTrue(is_array($result));
        $this->assertTrue(in_array('bat', $result));
        $this->assertTrue(in_array('hat', $result));
        $this->assertTrue(in_array('cat', $result));
    }

    public function testWordsReturnsEmptyWhenNoWordsOfLengthExist()
    {
        $dictionary = new FileDictionary(__DIR__.'/../../fixtures/words');
        $result = $dictionary->words(9);
        $this->assertTrue(is_array($result));
        $this->assertSame(0, count($result));
    }

    public function testWordsReturnsArrayOfWords()
    {
        $dictionary = new FileDictionary(__DIR__.'/../../fixtures/words');
        $result = $dictionary->words(3);
        $this->assertTrue(is_array($result));
        $this->assertSame(3, count($result));
    }

    public function testLongestWordReturnsZeroWhenNoWordsSet()
    {
        $dictionary = new FileDictionary(__DIR__.'/../../fixtures/empty-words');
        $result = $dictionary->longestWord();
        $this->assertSame(0, $result);
    }

    public function testLongestWord()
    {
        $dictionary = new FileDictionary(__DIR__.'/../../fixtures/words');
        $result = $dictionary->longestWord();
        $this->assertSame(6, $result);
    }
}
