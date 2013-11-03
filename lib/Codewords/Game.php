<?php namespace Codewords;

use Codewords\CsvBoardReader;
use Codewords\CellCollection;
use Codewords\BoardFactory;

/**
* The central class for a Codewords applications
*/
class Game
{
    protected $cells;

    protected $dictionary;

    protected $board;

    /**
    * @todo pass IBoardReader to contructor?
    */
    public function __construct($data, IDictionary $dictionary)
    {
        $reader = new CsvBoardReader($data);
        $this->cells = new CellCollection;
        $factory = new BoardFactory($reader, $this->cells);
        $this->board = $factory->create();
        $this->dictionary = $dictionary;
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

    public function getDictionary()
    {
        return $this->dictionary;
    }
}
