<?php namespace Codewords\Stats;

use Codewords\Stats\FirstLetterCount;
use Codewords\Stats\FollowingLetterCount;
use Codewords\Stats\DoubleLetterCount;
use Codewords\Stats\LastLetterCount;
use Codewords\Stats\LetterCount;
use Codewords\Error\UnknownStatName;

/**
* Provides access to IGameStats instances
*/
class StatsRepository
{
    public function getStat($name)
    {
        switch ($name){
            case 'FirstLetter':
                return new FirstLetterCount;
            case 'DoubleLetter':
                return new DoubleLetterCount;
            case 'LastLetter':
                return new LastLetterCount;
            case 'Letter':
                return new LetterCount;
            case 'FollowingLetter':
                return new FollowingLetterCount;
        }
        throw new UnknownStatName("'$name' is not an IGameStats class name");
    }
}
