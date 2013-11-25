<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Solver\FindLetter;
use Codewords\Solver\NotDoubleRule;
use Codewords\Solver\NotLastRule;

/**
* Supplies IFinder instances for specific Letters
* @todo pass Game to constructor
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
        switch($letter){
            case 'Q':
                $rules []= new NotDoubleRule($this->game->getBoard(), $this->game->getStatsRepository());
                $rules []= new NotLastRule($this->game->getBoard(), $this->game->getStatsRepository());
                break;
            case 'I':
                $rules []= new NotDoubleRule($this->game->getBoard(), $this->game->getStatsRepository());
                break;
        }
        return $rules;
    }
}
