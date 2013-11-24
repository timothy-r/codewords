<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Board\Cell;
use Codewords\Board\CellCollection;

/**
* @group unit
*/
class CellCollectionTest extends BaseTest
{
    public function testGetCellReturnsACell()
    {
        $cell_collection = new CellCollection;
        $cell = $cell_collection->at(1);
        $this->assertInstanceOf('Codewords\Board\Cell', $cell);
    }

    public function testCallsToGetCellReturnsSameInstance()
    {
        $cell_collection = new CellCollection;
        $cell_1 = $cell_collection->at(1);
        $cell_2 = $cell_collection->at(1);
        // assertSame tests that the two objects reference the same instance
        $this->assertSame($cell_1, $cell_2);
    }
    
    public function getInvalidCellNumbers()
    {
        return [
            [345],
            [-99]
        ];
    }

    /**
    * @expectedException Codewords\Error\InvalidCellNumber
    * @dataProvider getInvalidCellNumbers
    */
    public function testGetCellRespectsValidCellRange($number)
    {
        $cell_collection = new CellCollection;
        $cell = $cell_collection->at($number);
    }

    public function testGetCellReturnsAReferenceToACell()
    {
        $cell_collection = new CellCollection;
        $cell_1 = $cell_collection->at(1);
        $cell_1->setCharacter('A');
        $cell_2 = $cell_collection->at(1);
        $this->assertSame('A', $cell_2->getCharacter());
    }

    public function testCellForCharacter()
    {
        $cell_collection = new CellCollection;
        $cell = $cell_collection->at(1);
        $cell->setCharacter('S');
        $other_cell = $cell_collection->cellForCharacter('S');
        $this->assertTrue($cell->matches($other_cell));
    }

    public function testCellForCharacterReturnsNullWhenNoneFound()
    {
        $cell_collection = new CellCollection;
        $cell = $cell_collection->cellForCharacter('S');
        $this->assertSame(null, $cell);
    }

    public function testAllCellsInNewCollectionAreUnsolved()
    {
        $cell_collection = new CellCollection;
        $unsolved = $cell_collection->getUnsolved();
        $this->assertSame(26, count($unsolved));

        foreach($unsolved as $cell) {
            $this->assertFalse($cell->isSolved());
        }
    }

    public function testGetUnsolvedDoesNotIncludeSolvedCells()
    {
        $cell_collection = new CellCollection;
        $cell = $cell_collection->at(1);
        $cell->setCharacter('S');
        $cell = $cell_collection->at(2);
        $cell->setCharacter('Y');
        $unsolved = $cell_collection->getUnsolved();
        $this->assertSame(24, count($unsolved));

        foreach($unsolved as $cell) {
            $this->assertFalse($cell->isSolved());
        }
    }
    
    public function getLengths()
    {
        return [
            [26],
            [13]
        ];
    }

    /**
    * @dataProvider getLengths
    */
    public function testLengthReturnsCollectionLength($length)
    {
        $cell_collection = new CellCollection($length);
        $this->assertSame($length, $cell_collection->length());
    }

    public function testGetSolvedDoesNotIncludeUnsolvedCells()
    {
        $cell_collection = new CellCollection;
        $cell = $cell_collection->at(1);
        $cell->setCharacter('S');
        $cell = $cell_collection->at(2);
        $cell->setCharacter('Y');
        $solved = $cell_collection->getSolved();
        $this->assertSame(2, count($solved));

        foreach($solved as $cell) {
            $this->assertTrue($cell->isSolved());
        }
    }
}
