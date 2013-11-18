<?php namespace Codewords;

use Codewords\CsvBoardReader;
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
        $this->stats_repository = new StatsRepository;
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

    public function getStatsRepository()
    {
        return $this->stats_repository;
    }
}
