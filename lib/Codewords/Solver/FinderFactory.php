<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Solver\FindLetter;
use Codewords\Solver\NotDoubleRule;
use Codewords\Solver\NotLastRule;
use Codewords\Solver\FollowedByRule;
use Codewords\Stats\StatsRepository;

/**
* Supplies IFinder instances for specific Letters
*/
class FinderFactory
{
    protected $finders = [];
    
    protected $stats_repository;

    public function __construct(Game $game, StatsRepository $stats_repository)
    {
        $this->game = $game;
        $this->stats_repository = $stats_repository;
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
        switch($letter){
            case 'i':
                $rules []= new NotDoubleRule($this->game->getBoard(), $this->stats_repository);
                break;
            case 'q':
                $rules []= new NotDoubleRule($this->game->getBoard(), $this->stats_repository);
                $rules []= new NotLastRule($this->game->getBoard(), $this->stats_repository);
                // q can be followed by at most 2 different Cells, u & i
                // rather than specify the number of followers specify their Characters
                $rules []= new FollowedByRule($this->game->getBoard(), $this->stats_repository, 2);
                break;
            case 'u':
                // vacuum has a double u, and continuum
                $rules []= new NotDoubleRule($this->game->getBoard(), $this->stats_repository);
                // you ends in a u and bijou and fondu
                $rules []= new NotLastRule($this->game->getBoard(), $this->stats_repository);
                break;
        }
        return $rules;
    }
}
