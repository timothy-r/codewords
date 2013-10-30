<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Cell;
use Codewords\CellCollection;

/**
* @group unit
*/
class CellCollectionTest extends BaseTest
{
    public function testGetCell()
    {
        $cell_collection = new CellCollection;
        $cell = $cell_collection->cell(1);
        $this->assertInstanceOf('Codewords\Cell', $cell);
    }
}
