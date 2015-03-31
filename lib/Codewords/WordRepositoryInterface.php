<?php namespace Codewords;

use Codewords\Solver\WordPattern;

interface WordRepositoryInterface
{
    public function find(WordPattern $pattern, $length);
}


