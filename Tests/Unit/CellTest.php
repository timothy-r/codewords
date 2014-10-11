<?php

require_once(__DIR__ . '/BaseTest.php');

use Codewords\Test\UnitFixtureTrait;
use Codewords\Board\Cell;

/**
* @group unit
*/
class CellTest extends PHPUnit_Framework_TestCase
{
    use UnitFixtureTrait;

    public function setUp()
    {
        parent::setUp();
        $this->givenAMockBoard();
    }

    public function getValidCellNumbers()
    {
        return array_map(function($i){ return [$i];}, range(1,26));
    }
    
    /**
    * @dataProvider getValidCellNumbers
    */
    public function testCellHasANumber($number)
    {
        $cell = $this->getCell($number);
        $this->assertSame($number, $cell->getNumber());
    }

    public function testCanCellSetCharacter()
    {
        $char = 'Z';
        $cell = $this->getCell(1);
        $cell->setCharacter($char);
        $this->assertSame($char, $cell->getCharacter());
    }

    public function testCanCellSetCharacterInConstructor()
    {
        $char = 'Z';
        $cell = $this->getCell(1, $char);
        $this->assertSame($char, $cell->getCharacter());
    }

    public function testCellZeroIsNull()
    {
        $cell = $this->getCell(0);
        $this->assertTrue($cell->isNull());
    }

    /**
    * @dataProvider getValidCellNumbers
    */
    public function testNonZeroCellsAreNotNull($number)
    {
        $cell = $this->getCell($number);
        $this->assertFalse($cell->isNull());
    }
    
    public function getInvalidCellNumbers()
    {
        return [
            [-1], [30], ['x'], [null]
        ];
    }

    /**
    * @dataProvider getInvalidCellNumbers
    * @expectedException Codewords\Error\InvalidCellNumber
    */
    public function testCellsValidateNumberRange($number)
    {
        $cell = $this->getCell($number);
    }

    public function testTwoCellsWithSameNumberMatch()
    {
        $cell_1 = $this->getCell(1);
        $cell_2 = $this->getCell(1);
        $this->assertTrue($cell_1->matches($cell_2));
        $this->assertTrue($cell_2->matches($cell_1));
    }

    public function testTwoCellsWithDifferentNumbersDontMatch()
    {
        $cell_1 = $this->getCell(1);
        $cell_2 = $this->getCell(5);
        $this->assertFalse($cell_1->matches($cell_2));
        $this->assertFalse($cell_2->matches($cell_1));
    }

    public function testCellWithoutLetterIsNotSolved()
    {
        $cell = $this->getCell(1);
        $this->assertFalse($cell->isSolved());
    }

    public function testCellWithLetterIsSolved()
    {
        $cell = $this->getCell(1);
        $cell->setCharacter('W');
        $this->assertTrue($cell->isSolved());
    }

    public function testGetWords()
    {
        $this->givenABoard();
        $cell = new Cell($this->board, 1);
        $words = $cell->getWords();
        $this->assertTrue(is_array($words), "Expected getWords to return an array");
    }

    public function testGetBoard()
    {
        $cell = $this->getCell(1);
        $board = $cell->getBoard();
        $this->assertInstanceOf('Codewords\Board\Board', $board);
    }
}
