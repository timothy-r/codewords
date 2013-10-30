<?php namespace Codewords;

class BoardFactory
{
    
    protected $reader;

    public function __construct(IBoardReader $reader)
    {
        $this->reader = $reader;
    }

    public function create()
    {
        $board = new Board;
        $length = 12;

        // get each cell value from reader and add to Board
        // reader->numberAt($x, $y);
        // return BoardA
        return $board;
    }
}
