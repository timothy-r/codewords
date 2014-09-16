<?php namespace Codewords;

use Codewords\Board\CsvBoardReader;
use Codewords\Board\CellCollection;
use Codewords\Board\BoardFactory;

/**
* Loads a Board from data
*/
class BoardLoader
{
    /**
    * Interpret data
    * choose a reader
    * return a Board
    */
    public function load($data)
    {
        // passing the Reader to the Factory means we can switch Reader without affecting Factory
        $reader = new CsvBoardReader($data);
        $factory = new BoardFactory();
        return $factory->create($reader);
    }
}
