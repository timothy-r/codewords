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
    public function getLetters()
    {
        return [
            ['J', [[0, null], [1, 'O'], [2, null], [3, 'E']], '^(J)(O).(E)$'],
            ['W', [[0, null], [1, 'A'], [2, null], [4, null]], '^(W)(A)..$'],
            ['D', [[0, null], [1, 'R'], [2, null], [3, null], [4, 'T'], [5, 'Y']], '^(D)(R)..(T)(Y)$'],
            ['W', [[0, null], [1, null], [2, 'L'], [2, 'L']], '^(W).(L)\2$'],
            ['W', [[0, null], [1, 'E'], [2, null], [1, 'E']], '^(W)(E).\2$'],
            ['D', [[0, null], [1, 'R'], [2, null], [1, 'R'], [4, 'T'], [5, 'Y']], '^(D)(R).\2(T)(Y)$'],
            ['D', [[0, null], [1, 'R'], [2, null], [3, 'E'], [4, 'T'], [4, 'T']], '^(D)(R).(E)(T)\4$'],
        ];
    }

    /**
    * @dataProvider getLetters
    */
    public function testMakeForLetter($letter, $cell_data, $expected)
    {
        $word = $this->makeWord($cell_data);
        $word_pattern = new WordPattern;
        $cell = $word->at(0);
        $actual = $word_pattern->make($letter, $cell, $word); 
        $this->assertSame($expected, $actual);
    }

    /**
    * @dataProvider getLetters
    */
    public function testMakeForDuplicatedLetter($letter)
    {
        $cell_1 = new Cell(1);
        $cell_2 = new Cell(2);
        $cell_2->setCharacter('O');
        $cell_4 = new Cell(4);
        $cell_4->setCharacter('E');
        $word = new Word([$cell_1, $cell_2, $cell_1, $cell_4]);
        $word_pattern = new WordPattern;
        $actual = $word_pattern->make($letter, $cell_1, $word); 
        $expected = sprintf('^(%s)(O)(%s)(E)$', $letter, $letter);
        $this->assertSame($expected, $actual);
    }

    protected function makeWord($cell_data)
    {
        $cells = [];
        foreach($cell_data as $cell){
            $cells []= $this->makeCell($cell[0], $cell[1]);
        }
        return new Word($cells);
    }

    protected function makeCell($index, $letter)
    {
        $cell = new Cell($index);
        if (!is_null($letter)){
            $cell->setCharacter($letter);
       }
       return $cell;
    }
}
