<?php namespace Codewords;

use Codewords\Board\CsvBoardReader;
use Codewords\Board\CellCollection;
use Codewords\Board\BoardFactory;
use Codewords\Stats\StatsRepository;

/**
* The central class for a Codewords applications
*/
class Game
{
    protected $cells;

    protected $dictionary;

    protected $board;

    protected $stats_repository;

    protected $data;

    /**
    * @todo pass IBoardReader to contructor?
    */
    public function __construct($data, IDictionary $dictionary)
    {
        $this->data = $data;
        $this->dictionary = $dictionary;
        $this->cells = new CellCollection;
        $this->stats_repository = new StatsRepository;
    }

    protected function readBoard()
    {
        $reader = new CsvBoardReader($this->data);
        $factory = new BoardFactory($reader, $this->cells);
        $this->board = $factory->create();
    }

    /**
    * @return Codewords\Board
    */
    public function getBoard()
    {
        if (!$this->board){
            $this->readBoard();
        }
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

    public function getStatsRepository()
    {
        return $this->stats_repository;
    }
}
