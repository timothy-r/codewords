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
        $cell_1 = new Cell(1);
        $cell_2 = new Cell(2);
        $cell_2->setCharacter('O');
        $cell_3 = new Cell(3);
        $cell_4 = new Cell(4);
        $cell_4->setCharacter('E');
        $word = new Word([$cell_1, $cell_2, $cell_3, $cell_4]);
        $word_pattern = new WordPattern;
        $actual = $word_pattern->make($letter, $cell_1, $word); 
        $expected = '^JO.E$';
        $this->assertSame($expected, $actual);
    }
}
