<?php namespace Ace\Codewords;

interface BoardReaderInterface
{
    public function read($data);

    public function numberAt($x, $y);

    public function length();
}
