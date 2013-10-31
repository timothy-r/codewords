<?php
require_once(__DIR__ . '/BaseTest.php');

use Codewords\CsvBoardReader;

/**
* @group unit
*/
class CsvBoardReaderTest extends BaseTest
{
    protected $data;

    public function setUp()
    {
        parent::setUp();
        $this->data = "1,2,3,4,5,6,7,8,9,10,11,12,13\n".
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
                "1,2,3,4,5,6,7,8,9,10,11,12,13\n";
    }

    public function getValidInput()
    {
        return [
            [0,0,'1'],
            [1,1,'2'],
            [12,12,'13'],
        ];
    }

    /**
    * @dataProvider getValidInput
    */
    public function testNumberAt($x, $y, $expected)
    {
        $reader = new CsvBoardReader($this->data);
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
    * @expectedException Codewords\InvalidBoardLocation
    */
    public function testNumberAtValidatesInput($x, $y)
    {
        $reader = new CsvBoardReader($this->data);
        $number = $reader->numberAt($x, $y);
    }
    
    public function getInvalidBoardData()
    {
        return [
            [''],
            [null],
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
    * @expectedException Codewords\InvalidBoardData
    */
    public function testCsvBoardReaderValidatesData($invalid_data)
    {
        $reader = new CsvBoardReader($invalid_data);
    }
}
