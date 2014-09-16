<?php namespace Codewords\Test;

use Codewords\Game;
use Codewords\BoardLoader;
use Codewords\Dictionary\FileDictionary;
use Codewords\Dictionary\SortedDictionary;
use Codewords\Stats\StatsRepository;
use Exception;

trait IntegrationFixtureTrait
{
    /**
    * @var Codewords\IDictionary
    */
    protected $dictionary;
    
    /**
    * @var Codewords\Game
    */
    protected $game;
    
    /**
    * @var Codewords\Board\Board
    */
    protected $board;

    /**
    * @var Codewords\Stats\StatsRepository
    */
    protected $stats_repository;

    protected function givenAFileDictionary()
    {
        $file = __DIR__ . '/../../../config/words';
        //$words = file(__DIR__.'/../../config/words');
        $this->dictionary = new FileDictionary($file);
    }
    
    protected function givenASortedDictionary()
    {
        $file = __DIR__ . '/../../../config/dict-3';
        $this->dictionary = new SortedDictionary($file);
    }

    protected function givenAGame($data)
    {
        $this->game = new Game($this->dictionary);
        $this->game->load($this->getFixture($data));
    }
    
    protected function givenABoard($data)
    {
        $loader = new BoardLoader();
        $this->board = $loader->load($this->getFixture($data));
    }

    protected function givenAStatsRepository()
    {
        $this->stats_repository = new StatsRepository;
    }

    public function getValidGameData()
    {
        return [
            ['data-1.csv', 'data-1-expectation.html']
        ];
    }
}
