<?php namespace Ace\Codewords\Test;

use Ace\Codewords\BoardLoader;
use Ace\Codewords\Board\CsvBoardReader;
use Ace\Codewords\Board\BoardFactory;
use Ace\Codewords\Dictionary\FileDictionary;
use Ace\Codewords\Dictionary\SortedDictionary;
use Ace\Codewords\Stats\StatsRepository;
use Exception;

trait IntegrationFixtureTrait
{
    /**
    * @var Ace\Codewords\DictionaryInterface
    */
    protected $dictionary;
    
    /**
    * @var Ace\Codewords\Board\Board
    */
    protected $board;

    /**
    * @var Ace\Codewords\Stats\StatsRepository
    */
    protected $stats_repository;
    
    protected $board_reader;

    protected $board_factory;

    protected function givenAFileDictionary()
    {
        $file = __DIR__ . '/../../../../data/words';
        //$words = file(__DIR__.'/../../data/words');
        $this->dictionary = new FileDictionary($file);
    }
    
    protected function givenASortedDictionary()
    {
        $file = __DIR__ . '/../../../../data/dict-3';
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
