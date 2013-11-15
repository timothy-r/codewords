<?php
require_once(__DIR__ . '/IntegrationTest.php');

use Codewords\Dictionary\FileDictionary;

/**
* @group unit
*/
class FileDictionaryTest extends IntegrationTest
{
    public function testFindReturnsAllMatchingWords()
    {
        $pattern = '^.a.$';
        $dictionary = new FileDictionary(__DIR__.'/../../config/words');
        $result = $dictionary->find($pattern);

        $this->assertTrue(is_array($result));
        $this->assertTrue(in_array('Ian', $result));
        $this->assertTrue(in_array('lap', $result));
    }
}
