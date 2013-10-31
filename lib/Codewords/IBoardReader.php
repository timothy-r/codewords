<?php namespace Codewords;

interface IBoardReader
{
    public function numberAt($x, $y);

    public function length();
}
