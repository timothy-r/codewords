<?php namespace Codewords\Board;

use Codewords\BoardReaderInterface;
use Codewords\Board\CellCollection;
use Codewords\Error\InvalidBoardData;

class BoardFactory
{
    /**
    * Creates a Board from the data supplied by IBoardReader
    * Validate the Board after creation
    *
    * @return Codewords\Board
    */
    public function create(BoardReaderInterface $reader)
    {
        $length = $reader->length();
        $board = new Board($length);

        for ($y = 0; $y <= $length - 1; $y++) {
            for($x = 0; $x <= $length - 1; $x++) {
                // get each cell value from reader and add the Cell to the Board
                $number = $reader->numberAt($x, $y);
                //$cell = $this->cells->at($number);
                $board->addCell($number, $x, $y);
            }
        }
        
        // perform validation
        $frequencies = $board->getFrequencies();
        if (count($frequencies) !== 26){
            throw new InvalidBoardData("There must be 26 characters on the board. There are " . count($frequencies));
        }

        foreach($frequencies as $number => $count){
            if (0 === $count){
                throw new InvalidBoardData("Each character must appear at least one. $number appears 0 times.");
            }
        }

        return $board;
    }
}
