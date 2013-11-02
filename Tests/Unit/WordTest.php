<?php

require_once(__DIR__ . '/BaseTest.php');

use Codewords\Word;

/**
* @group unit
*/
class WordTest extends BaseTest
{
    public function testWordHasLetters()
    {
        $word = new Word;
        $letter = $word->letter(1);
    }
}
