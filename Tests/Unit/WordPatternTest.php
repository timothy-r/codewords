<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Board\Cell;
use Codewords\Board\Word;
use Codewords\Solver\WordPattern;

/**
* @group unit
*/
class WordPatternTest extends BaseTest
{
    /**
    *
    */
    public function testMakeForLetter()
    {
        $letter = 'J';
        $cells = [];
        $word = new Word($cells);
        $word_pattern = new WordPattern;
       
    }
}
