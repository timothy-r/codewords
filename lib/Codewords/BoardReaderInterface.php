<?php namespace Codewords;

interface BoardReaderInterface
{
    public function numberAt($x, $y);

    public function length();
}
