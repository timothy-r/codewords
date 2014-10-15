<?php namespace Codewords;

use Codewords\Board\CsvBoardReader;
use Codewords\Board\CellCollection;
use Codewords\Board\BoardFactory;

/**
* Loads a Board from data
*/
class BoardLoader
{
    
    private $reader;

    private $factory;

    public function __construct(BoardReaderInterface $reader, BoardFactory $factory)
    {
        $this->reader = $reader;
        $this->factory = $factory;
    }

    /**
    * Interpret data
    * choose a reader
    * return a Board
    */
    public function load($data)
    {
        // passing the Reader to the Factory means we can switch Reader without affecting Factory
        $this->reader->read($data);
        return $this->factory->create($this->reader);
    }
}
