<?php namespace Codewords;

use Codewords\CsvBoardReader;
use Codewords\CellCollection;
use Codewords\BoardFactory;

/**
* The central class for a Codewords applications
*/
class Game
{
    /**
    * @todo pass IBoardReader to contructor?
    */
    public function __construct($data)
    {
        $reader = new CsvBoardReader($data);
        $this->cells = new CellCollection;
        $factory = new BoardFactory($reader, $this->cells);
        $this->board = $factory->create();
        // validate the Board here?
    }

    /**
    * @return Codewords\Board
    */
    public function getBoard()
    {
        return $this->board;
    }

    /**
    * @return Codewords\CellCollection
    */
    public function getCells()
    {
        return $this->cells;
    }
}
