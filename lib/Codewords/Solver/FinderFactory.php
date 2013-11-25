<?php namespace Codewords\Solver;

use Codewords\Solver\FindLetter;
use Codewords\Solver\NotDoubleRule;

/**
* Supplies IFinder instances for specific Letters
*/
class FinderFactory
{
    protected $finders = [];

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
                #$rules []= new NotDoubleRule
                break;
        }
        return $rules;
    }
}
