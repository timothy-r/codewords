<?php namespace Codewords;

use Codewords\IBoardReader;
use Codewords\InvalidBoardLocation;

/**
* Reads from a Csv data source
*
* $data = str_getcsv($CsvString, "\n"); //parse the rows 
* foreach($data as &$row) $row = str_getcsv($row, ","); //parse the items in rows
*/
class CsvBoardReader implements IBoardReader
{
    public function __construct($data)
    {
        $this->data = [];
        $lines = str_getcsv($data, "\n");
        foreach($lines as $line) {
            $this->data []= str_getcsv($line, ",");
        }
    }

    public function numberAt($x, $y)
    {
        if ($x < 0 || $x > 13) {
            throw new InvalidBoardLocation("x value '$x' is invalid");
        }
        if ($y < 0 || $y > 13) {
            throw new InvalidBoardLocation("y value '$y' is invalid");
        }

        return $this->data[$y][$x];
    }
}
