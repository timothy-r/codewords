<?php namespace Codewords;

interface SourceInterface
{
    /*
    * Take input data string and return standard csv format data expected by CsvBoardReader
    */
    public function read($data);
}
