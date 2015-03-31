<?php namespace Ace\Codewords\Stats;

use Ace\Codewords\Error\UnknownStatName;

/**
* Provides access to GameStatsInterface instances
*/
class StatsRepository
{
    protected $stats = [];

    public function getStat($name)
    {
        switch ($name){
            case 'FirstLetter':
                return $this->getStatInstance($name, 'Ace\Codewords\Stats\FirstLetterCount');
            case 'DoubleLetter':
                return $this->getStatInstance($name, 'Ace\Codewords\Stats\DoubleLetterCount');
            case 'LastLetter':
                return $this->getStatInstance($name, 'Ace\Codewords\Stats\LastLetterCount');
            case 'Letter':
                return $this->getStatInstance($name, 'Ace\Codewords\Stats\LetterCount');
            case 'FollowingLetter':
                return $this->getStatInstance($name, 'Ace\Codewords\Stats\FollowingLetterCount');
        }
        throw new UnknownStatName("'$name' is not an GameStatsInterface class name");
    }

    protected function getStatInstance($name, $class)
    {
        if (!isset($this->stats[$name])){
            $this->stats[$name] = new $class;
        }
        return $this->stats[$name];
    }
}
