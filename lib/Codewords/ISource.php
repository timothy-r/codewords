<?php namespace Codewords;

interface ISource
{
    /*
    * Take input data string and return standard csv format data expected by CsvBoardReader
    */
    public function read($data);
}
