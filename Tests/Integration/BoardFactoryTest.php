<?php
require_once(__DIR__ . '/IntegrationTest.php');

use Codewords\Board;
#use Codewords\Cell;
use Codewords\BoardFactory;
use Codewords\CellCollection;
#use Codewords\IBoardReader;
use Codewords\CsvBoardReader;

/**
* @group integration
*/
class BoardFactoryTest extends IntegrationTest
{

    public function getValidGameData()
    {
        return [
            ['data-1.csv']
        ];
    }

    public function getInvalidGameData()
    {
        return [
            // has no instance of character 3
            ['data-2.csv']
        ];
    }
    
    /**
    * @dataProvider getValidGameData
    */
    public function testCreateReturnsABoard($fixture)
    {
        $data = $this->getFixture($fixture);
        $reader = new CsvBoardReader($data);
        $cells = new CellCollection;
        
        $factory = new BoardFactory($reader, $cells);
        $product = $factory->create();
        $this->assertInstanceOf('Codewords\Board', $product);
    }

    /**
    * @dataProvider getInvalidGameData
    * @expectedException Codewords\Error\InvalidBoardData
    */
    public function testCreateValidatesBoardCharacters($fixture)
    {
        $data = $this->getFixture($fixture);
        $reader = new CsvBoardReader($data);
        $cells = new CellCollection;
        
        $factory = new BoardFactory($reader, $cells);
        $product = $factory->create();
    }
}
