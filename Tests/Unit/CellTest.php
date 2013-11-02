<?php

require_once(__DIR__ . '/BaseTest.php');

use Codewords\Cell;

/**
* @group unit
*/
class CellTest extends BaseTest
{
    public function getValidCellNumbers()
    {
        return array_map(function($i){ return [$i];}, range(1,26));
    }

    /**
    * @dataProvider getValidCellNumbers
    */
    public function testCellHasANumber($number)
    {
        $cell = new Cell($number);
        $this->assertSame($number, $cell->getNumber());
    }

    public function testCanCellSetCharacter()
    {
        $char = 'Z';
        $cell = new Cell(1);
        $cell->setCharacter($char);
        $this->assertSame($char, $cell->getCharacter());
    }

    public function testCellZeroIsNull()
    {
        $cell = new Cell(0);
        $this->assertTrue($cell->isNull());
    }

    /**
    * @dataProvider getValidCellNumbers
    */
    public function testNonZeroCellsAreNotNull($number)
    {
        $cell = new Cell($number);
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
    * @expectedException Codewords\InvalidCellNumber
    */
    public function testCellsValidateNumberRange($number)
    {
        $cell = new Cell($number);
    }
}
