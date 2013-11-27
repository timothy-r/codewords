<?php namespace Codewords\Test;

use Codewords\Game;
use Codewords\Dictionary\FileDictionary;
use Codewords\Dictionary\SortedDictionary;
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

    protected function getFixture($name)
    {
        $file = __DIR__ . '/../../../Tests/fixtures/' . $name;
        if (is_file($file)){
            return file_get_contents($file);
        }
        throw new Exception("File $file does not exist");
    }

    protected function requireFixture($name)
    {
        $file = __DIR__ . '/../../../Tests/fixtures/' . $name;
        if (is_file($file)){
            return require_once($file);
        }
        throw new Exception("File $file does not exist");
    }

    public function getValidGameData()
    {
        return [
            ['data-1.csv', 'data-1-expectation.html']
        ];
    }
}
