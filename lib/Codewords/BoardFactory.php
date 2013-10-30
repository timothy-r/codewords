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

        for ($y = 0; $y <= $length; $y++) {
            for($x = 0; $x <= $length; $x++) {
                // get each cell value from reader and add to Board
                $number = $this->reader->numberAt($x, $y);
                $cell = new Cell($number);
                $board->addCell($cell, $x, $y);
            }
        }
        // return Board
        return $board;
    }
}
