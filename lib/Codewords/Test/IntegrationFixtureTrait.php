<?php namespace Codewords\Test;

use Codewords\BoardLoader;
use Codewords\Board\CsvBoardReader;
use Codewords\Board\BoardFactory;
use Codewords\Dictionary\FileDictionary;
use Codewords\Dictionary\SortedDictionary;
use Codewords\Stats\StatsRepository;
use Exception;

trait IntegrationFixtureTrait
{
    /**
    * @var Codewords\DictionaryInterface
    */
    protected $dictionary;
    
    /**
    * @var Codewords\Board\Board
    */
    protected $board;

    /**
    * @var Codewords\Stats\StatsRepository
    */
    protected $stats_repository;
    
    protected $board_reader;

    protected $board_factory;

    protected function givenAFileDictionary()
    {
        $file = __DIR__ . '/../../../data/words';
        //$words = file(__DIR__.'/../../data/words');
        $this->dictionary = new FileDictionary($file);
    }
    
    protected function givenASortedDictionary()
    {
        $file = __DIR__ . '/../../../data/dict-3';
        $this->dictionary = new SortedDictionary($file);
    }

    protected function givenABoard($data)
    {
        $loader = new BoardLoader($this->board_reader, $this->board_factory);
        $this->board = $loader->load($this->getFixture($data));
    }

    protected function givenAStatsRepository()
    {
        $this->stats_repository = new StatsRepository;
    }

    public function getValidBoardData()
    {
        return [
            ['data-1.csv', 'data-1-expectation.html']
        ];
    }

    protected function givenACsvBoardReader()
    {
        $this->board_reader = new CsvBoardReader;
    }

    protected function givenABoardFactory()
    {
        $this->board_factory = new BoardFactory;
    }
}
