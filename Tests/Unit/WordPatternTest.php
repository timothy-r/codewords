<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Board\Cell;
use Codewords\Board\CellCollection;
use Codewords\Board\Word;
use Codewords\Solver\WordPattern;
use Codewords\Test\UnitFixtureTrait;
/**
* @group unit
*/
class WordPatternTest extends BaseTest
{
    use UnitFixtureTrait;

    protected $cells;

    public function setUp()
    {
        parent::setUp();
        $this->givenAMockBoard();
        $this->cells = new CellCollection($this->board);
    }

    public function getLetters()
    {
        return [
            ['J', [[0, null], [1, 'O'], [2, null], [2, null]], '^JO([^J|O])\1$', 0],
            ['W', [[0, null], [1, 'A'], [2, null], [4, null]], '^WA([^A|W])([^A|W])$', 0],
            ['W', [[0, null], [1, null], [2, 'L'], [1, null]], '^W([^L|W])L\1$', 0],
            ['D', [[0, null], [1, 'R'], [2, null], [2, null], [4, 'T'], [5, 'Y']], '^DR([^D|R|T|Y])\1TY$', 0],
            ['D', [[0, null], [1, 'R'], [2, null], [3, 'E'], [4, 'T'], [2, null]], '^DR([^D|E|R|T])ET\1$', 0],
        ];
    }

    /**
    * @dataProvider getLetters
    */
    public function testMakeForLetter($letter, $cell_data, $expected, $position)
    {
        $word = $this->makeWord($cell_data);
        $word_pattern = new WordPattern($this->cells);
        $cell = $word->at($position);
        $actual = $word_pattern->make($letter, $cell, $word); 
        $this->assertSame($expected, $actual);
    }

    /**
    * @dataProvider getLetters
    */
    public function testMakeForDuplicatedLetter($letter)
    {
        $cell_1 = $this->cells->at(1);
        $cell_2 = $this->cells->at(2);
        $cell_2->setCharacter('O');
        $cell_4 = $this->cells->at(4);
        $cell_4->setCharacter('E');
        $word = new Word([$cell_1, $cell_2, $cell_1, $cell_4]);
        $word_pattern = new WordPattern($this->cells);
        $actual = $word_pattern->make($letter, $cell_1, $word); 
        $expected = sprintf('^%sO%sE$', $letter, $letter);
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
        $cell = $this->cells->at($index);
        if (!is_null($letter)){
            $cell->setCharacter($letter);
       }
       return $cell;
    }
}
