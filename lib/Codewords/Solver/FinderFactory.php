<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Solver\FindLetter;
use Codewords\Solver\NotDoubleRule;
use Codewords\Solver\NotLastRule;
use Codewords\Solver\FollowedByRule;

/**
* Supplies IFinder instances for specific Letters
*/
class FinderFactory
{
    protected $finders = [];
    
    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function create($letter)
    {
        // get rules for Letter here
        $rules = $this->getRules($letter);
        return new FindLetter($letter, $rules);
    }

    protected function getRules($letter)
    {
        $rules = [];
        #§var_dump(__METHOD__ . " $letter");
        switch($letter){
            case 'i':
                $rules []= new NotDoubleRule($this->game->getBoard(), $this->game->getStatsRepository());
                break;
            case 'q':
                $rules []= new NotDoubleRule($this->game->getBoard(), $this->game->getStatsRepository());
                $rules []= new NotLastRule($this->game->getBoard(), $this->game->getStatsRepository());
                // q can be followed by at most 2 different Cells, u & i
                $rules []= new FollowedByRule($this->game->getBoard(), $this->game->getStatsRepository(), 2);
                break;
            case 'u':
                // vacuum has a double u, and continuum
                $rules []= new NotDoubleRule($this->game->getBoard(), $this->game->getStatsRepository());
                // you ends in a u and bijou and fondu
                $rules []= new NotLastRule($this->game->getBoard(), $this->game->getStatsRepository());
                break;
        }
        return $rules;
    }
}
