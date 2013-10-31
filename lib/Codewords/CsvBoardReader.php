<?php namespace Codewords;

use Codewords\IBoardReader;

/**
* Reads from a Csv data source
*
* $data = str_getcsv($CsvString, "\n"); //parse the rows 
* foreach($data as &$row) $row = str_getcsv($row, ","); //parse the items in rows
*/
class CsvBoardReader implements IBoardReader
{
    public function numberAt($x, $y)
    {
    }
}
