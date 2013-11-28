<?php namespace Codewords;

use Codewords\Board\CsvBoardReader;
use Codewords\Board\CellCollection;
use Codewords\Board\BoardFactory;
use Codewords\Stats\StatsRepository;

/**
* The central class for a Codewords applications
* @deprecated
* The only real functionality it provides is to load a Board
* All other class instances can be provided by di
*/
class Game
{
    protected $cells;

    protected $dictionary;

    protected $board;

    protected $stats_repository;

    public function __construct(IDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
        $this->cells = new CellCollection;
        $this->stats_repository = new StatsRepository;
    }

    public function load($data)
    {
        $reader = new CsvBoardReader($data);
        $factory = new BoardFactory($this->cells);
        $this->board = $factory->create($reader);
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
