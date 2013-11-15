<?php namespace Codewords\Stats;

use Codewords\Stats\LastLetterCount;

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
    }
}
