<?php

use Ace\Codewords\Test\IntegrationFixtureTrait;
use Ace\Codewords\Test\FixtureTrait;
use Ace\Codewords\Board\Board;
use Ace\Codewords\Board\BoardFactory;
use Ace\Codewords\Board\CsvBoardReader;

/**
* @group integration
*/
class BoardFactoryTest extends PHPUnit_Framework_TestCase
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
        $reader = new CsvBoardReader();
        $reader->read($data);

        $factory = new BoardFactory();
        $product = $factory->create($reader);
        $this->assertInstanceOf('Ace\Codewords\Board\Board', $product);
    }

    /**
    * @dataProvider getValidBoardData
    */
    public function testCreateReturnsABoardWithCorrectFrequencies($fixture, $expectation)
    {
        $data = $this->getFixture($fixture);
        $reader = new CsvBoardReader();
        $reader->read($data);
        
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
    * @expectedException Ace\Codewords\Error\InvalidBoardData
    */
    public function testCreateValidatesBoard($fixture)
    {
        $data = $this->getFixture($fixture);
        $reader = new CsvBoardReader();
        $reader->read($data);
        
        $factory = new BoardFactory();
        $product = $factory->create($reader);
    }
}
