<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\Board\CsvBoardReader;

/**
* @group unit
*/
class CsvBoardReaderTest extends PHPUnit_Framework_TestCase
{
    protected $data_13 = 
"1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n";

    protected $data_15 = 
"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n1,2,3,4,5,6,7,8,9,10,11,12,13,14,15\n";

    public function getValidInput()
    {
        return [
            [$this->data_13, 0, 0, '1'],
            [$this->data_13, 1, 1, '2'],
            [$this->data_13, 12, 12,'13'],
            [$this->data_15, 14, 14,'15'],
            [$this->data_15, 0, 14,'1'],
        ];
    }

    /**
    * @dataProvider getValidInput
    */
    public function testNumberAt($data, $x, $y, $expected)
    {
        $reader = new CsvBoardReader($data);
        $number = $reader->numberAt($x, $y);
        $this->assertSame($expected, $number);
    }

    public function getInvalidInput()
    {
        return [
            [-1, 0],
            [0, -1],
            [14, 0],
            [0, 14],
        ];
    }

    /**
    * @dataProvider getInvalidInput
    * @expectedException Codewords\Error\InvalidBoardLocation
    */
    public function testNumberAtValidatesInput($x, $y)
    {
        $reader = new CsvBoardReader($this->data_13);
        $number = $reader->numberAt($x, $y);
    }
    
    public function getInvalidBoardData()
    {
        return [
            ["1,2,3,4,5,6,7,8,9,10,11,12,13\n"],
            ["1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12\n"],

            ["1,2,3,4,5,6,7,8,9,10,11,12,13\n"],
            ["1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
            "1,2,3,4,5,6,7,8,9,10,11,12,13\n"],
        ];
    }

    /**
    * @dataProvider getInvalidBoardData
    * @expectedException Codewords\Error\InvalidBoardData
    */
    public function testCsvBoardReaderValidatesData($invalid_data)
    {
        $reader = new CsvBoardReader($invalid_data);
    }

    public function getBoardLengths()
    {
        return [
            [$this->data_13, 13],
            [$this->data_15, 15],
        ];
    }

    /**
    * @dataProvider getBoardLengths
    */
    public function testLengthReturnsBoardLength($data, $expected)
    {
        $reader = new CsvBoardReader($data);
        $length = $reader->length();
        $this->assertSame($expected, $length);
    }
}
