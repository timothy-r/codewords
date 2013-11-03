<?php
require_once(__DIR__ . '/IntegrationTest.php');
require_once(__DIR__. '/FixtureTrait.php');

use Codewords\Board;
use Codewords\BoardFactory;
use Codewords\CellCollection;
use Codewords\CsvBoardReader;

/**
* @group integration
*/
class BoardFactoryTest extends IntegrationTest
{
    use FixtureTrait;

    public function getValidGameData()
    {
        return [
            ['data-1.csv', 'data-1-expectation.php']
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
    * @dataProvider getValidGameData
    */
    public function testCreateReturnsABoardWithCorrectFrequencies($fixture, $expectation)
    {
        $data = $this->getFixture($fixture);
        $reader = new CsvBoardReader($data);
        $cells = new CellCollection;
        
        $factory = new BoardFactory($reader, $cells);
        $product = $factory->create();
        $frequencies = $product->getFrequencies();
        // test the frequency values
        $expected = $this->requireFixture($expectation);
        for($i = 1; $i < count($expected); $i++) {
            $this->assertSame($expected[$i], $frequencies[$i]);
        }
    }

    /**
    * @dataProvider getInvalidGameData
    * @expectedException Codewords\Error\InvalidBoardData
    */
    public function testCreateValidatesBoard($fixture)
    {
        $data = $this->getFixture($fixture);
        $reader = new CsvBoardReader($data);
        $cells = new CellCollection;
        
        $factory = new BoardFactory($reader, $cells);
        $product = $factory->create();
    }
}
