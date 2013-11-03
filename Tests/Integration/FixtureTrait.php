<?php

use Codewords\Game;
use Codewords\FileDictionary;

trait FixtureTrait
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
        $words = file(__DIR__.'/../../config/words');
        $this->dictionary = new FileDictionary($words);
    }

    protected function givenAGame($data)
    {
        $this->game = new Game($this->getFixture($data), $this->dictionary);
    }

    protected function getFixture($name)
    {
        $file = __DIR__ . '/../fixtures/' . $name;
        if (is_file($file)){
            return file_get_contents($file);
        }
        throw new Exception("File $file does not exist");
    }

    protected function requireFixture($name)
    {
        $file = __DIR__ . '/../fixtures/' . $name;
        if (is_file($file)){
            return require_once($file);
        }
        throw new Exception("File $file does not exist");
    }
}
