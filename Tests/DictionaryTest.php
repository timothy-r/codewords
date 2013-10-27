<?php

use Codewords\Dictionary;

class DictionaryTest extends BaseTest
{
    public function testFindReturnsMatches()
    {
        $pattern = '^.at$';
        $dictionary = new Dictionary
        $result = $dictionary->find($pattern);

        $this->assertTrue(is_array($result));

    }
}
