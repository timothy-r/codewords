<?php namespace Codewords;

use Codewords\IBoardReader;
use Codewords\CellCollection;

class BoardFactory
{
    /**
    * @var Codewords\IBoardReader
    */
    protected $reader;
    
    /**
    * @var Codewords\CellCollection
    */
    protected $cells;

    public function __construct(IBoardReader $reader, CellCollection $cells)
    {
        $this->reader = $reader;
        $this->cells = $cells;
    }

    public function create()
    {
        $board = new Board;
        // get length from $reader, don't hard code
        $length = 12;

        for ($y = 0; $y <= $length; $y++) {
            for($x = 0; $x <= $length; $x++) {
                // get each cell value from reader and add to Board
                $number = $this->reader->numberAt($x, $y);
                $cell = $this->cells->at($number);
                $board->addCell($cell, $x, $y);
            }
        }
        return $board;
    }
}
