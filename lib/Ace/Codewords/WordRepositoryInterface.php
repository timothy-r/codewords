<?php namespace Ace\Codewords;

use Ace\Codewords\Solver\WordPattern;

interface WordRepositoryInterface
{
    public function find(WordPattern $pattern, $length);
}


