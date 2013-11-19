<?php namespace Codewords\Solver;

use Codewords\Solver\FindLetter;

/**
* Supplies IFinder instances for specific Letters
*/
class FinderRepository
{
    protected $finders = [];

    public function getFinder($letter)
    {
        // get rules for Letter here
        $rules = [];
        return new FindLetter($letter, $rules);
    }
}
