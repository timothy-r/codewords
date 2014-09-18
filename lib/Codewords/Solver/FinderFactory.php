<?php namespace Codewords\Solver;

use Codewords\IDictionary;
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

    protected $dictonary;

    public function __construct(StatsRepository $stats_repository, IDictionary $dictionary)
    {
        $this->stats_repository = $stats_repository;
        $this->dictionary = $dictionary;
    }

    public function create($letter)
    {
        //printf("%s letter %s\n", __METHOD__, $letter);
        // get rules for Letter here
        $rules = $this->createRules($letter);
        return new FindLetter($this->dictionary, $letter, $rules);
    }

    protected function createRules($letter)
    {
        $rules = [];
        switch($letter){
            case 'i':
                $rules []= new NotDoubleRule($this->stats_repository);
                break;
            case 'q':
                $rules []= new NotDoubleRule($this->stats_repository);
                $rules []= new NotLastRule($this->stats_repository);
                // q can be followed by at most 2 different Cells, u & i
                // rather than specify the number of followers specify their Characters
                $rules []= new FollowedByRule($this->stats_repository, 2);
                break;
            case 'u':
                // vacuum has a double u, and continuum
                $rules []= new NotDoubleRule($this->stats_repository);
                // you ends in a u and bijou and fondu
                $rules []= new NotLastRule($this->stats_repository);
                break;
            case 'x':
                $rules []= new NotDoubleRule($this->stats_repository);
                break;
        }
        return $rules;
    }
}
