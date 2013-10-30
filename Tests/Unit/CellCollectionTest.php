<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Cell;
use Codewords\CellCollection;

/**
* @group unit
*/
class CellCollectionTest extends BaseTest
{
    public function testGetCellReturnsACell()
    {
        $cell_collection = new CellCollection;
        $cell = $cell_collection->cell(1);
        $this->assertInstanceOf('Codewords\Cell', $cell);
    }

    public function testCallsToGetCellReturnsSameInstance()
    {
        $cell_collection = new CellCollection;
        $cell_1 = $cell_collection->cell(1);
        $cell_2 = $cell_collection->cell(1);
        // assertSame tests that the two objects reference the same instance
        $this->assertSame($cell_1, $cell_2);
    }
    
    public function getValidCellNumbers()
    {
        return [
            [345],
            [0],
            [-99]
        ];
    }

    /**
    * @expectedException Codewords\InvalidCellLocation
    * @dataProvider getValidCellNumbers
    */
    public function testGetCellRespectsValidCellRange($number)
    {
        $cell_collection = new CellCollection;
        $cell = $cell_collection->cell($number);
    }

    public function testGetCellReturnsAReferenceToACell()
    {
        $cell_collection = new CellCollection;
        $cell_1 = $cell_collection->cell(1);
        $cell_1->setCharacter('A');
        $cell_2 = $cell_collection->cell(1);
        $this->assertSame('A', $cell_2->getCharacter());
    }
}
