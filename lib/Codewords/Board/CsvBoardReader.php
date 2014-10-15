<?php namespace Codewords\Board;

use Codewords\BoardReaderInterface;
use Codewords\Error\InvalidBoardLocation;
use Codewords\Error\InvalidBoardData;

/**
* Reads from a Csv data source
*/
class CsvBoardReader implements BoardReaderInterface
{
    /**
    * @var integer the side of the square board
    */
    protected $length;

    public function read($data)
    {
        $this->data = [];
        $lines = str_getcsv($data, "\n");

        // allow for longer lines than default
        // boards must be square
        $this->length = count($lines);
        foreach($lines as $line) {
            $line_data = str_getcsv($line, ",");
            if (count($line_data) !== $this->length){
                throw new InvalidBoardData(print_r($line_data,1) . " is invalid it is not {$this->length} long");
            }
            $this->data []= $line_data;
        }
    }
    
    /**
    * @var integer $x
    * @var integer $y
    * @return string (either an integer string or a blank)
    */
    public function numberAt($x, $y)
    {
        if ($x < 0 || $x > $this->length) {
            throw new InvalidBoardLocation("x value '$x' is invalid");
        }
        if ($y < 0 || $y > $this->length) {
            throw new InvalidBoardLocation("y value '$y' is invalid");
        }
        return $this->data[$y][$x];
    }

    public function length()
    {
        return $this->length;
    }
}
