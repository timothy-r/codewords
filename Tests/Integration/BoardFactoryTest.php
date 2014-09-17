<?php
require_once(__DIR__ . '/IntegrationTest.php');

use Codewords\Test\IntegrationFixtureTrait;
use Codewords\Test\FixtureTrait;
use Codewords\Board\Board;
use Codewords\Board\BoardFactory;
use Codewords\Board\CsvBoardReader;

/**
* @group integration
*/
class BoardFactoryTest extends IntegrationTest
{
    use IntegrationFixtureTrait;
    use FixtureTrait;

    public function getValidBoardData()
    {
        return [
            ['data-1.csv', 'data-1-expectation.php']
        ];
    }

    public function getInvalidBoardData()
    {
        return [
            // has no instance of character 3
            ['data-2.csv']
        ];
    }
    
    /**
    * @dataProvider getValidBoardData
    */
    public function testCreateReturnsABoard($fixture)
    {
        $data = $this->getFixture($fixture);
        $reader = new CsvBoardReader($data);
        
        $factory = new BoardFactory();
        $product = $factory->create($reader);
        $this->assertInstanceOf('Codewords\Board\Board', $product);
    }

    /**
    * @dataProvider getValidBoardData
    */
    public function testCreateReturnsABoardWithCorrectFrequencies($fixture, $expectation)
    {
        $data = $this->getFixture($fixture);
        $reader = new CsvBoardReader($data);

        
        $factory = new BoardFactory();
        $product = $factory->create($reader);
        $frequencies = $product->getFrequencies();
        // test the frequency values
        $expected = $this->requireFixture($expectation);
        for($i = 1; $i < count($expected); $i++) {
            $this->assertSame($expected[$i], $frequencies[$i]);
        }
    }

    /**
    * @dataProvider getInvalidBoardData
    * @expectedException Codewords\Error\InvalidBoardData
    */
    public function testCreateValidatesBoard($fixture)
    {
        $data = $this->getFixture($fixture);
        $reader = new CsvBoardReader($data);
        
        $factory = new BoardFactory();
        $product = $factory->create($reader);
    }
}
