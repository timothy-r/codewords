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
        // get length from $reader, don't hard code
        $length = $this->reader->length();
        $board = new Board($length);

        for ($y = 0; $y <= $length - 1; $y++) {
            for($x = 0; $x <= $length - 1; $x++) {
                // get each cell value from reader and add to Board
                $number = $this->reader->numberAt($x, $y);
                $cell = $this->cells->at($number);
                $board->addCell($cell, $x, $y);
            }
        }
        return $board;
    }
}
