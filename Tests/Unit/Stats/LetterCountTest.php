<?php
require_once(__DIR__ . '/../BaseTest.php');

use Codewords\Board;
use Codewords\Stats\LetterCount;
use Codewords\Test\UnitFixtureTrait;

class LetterCountTest extends BaseTest
{
    use UnitFixtureTrait;

    public function testGenerateCountsLettersInBoard()
    {
        $board = $this->createBoard();
        $game = $this->getMock('Codewords\Game', ['getBoard'], [], '', false);
        $game->expects($this->any())
            ->method('getBoard')
            ->will($this->returnValue($board));

        $letter_count = new LetterCount();

        $stats = $letter_count->generate($game);

        $this->assertSame(1, $stats[1]);
        $this->assertSame(1, $stats[2]);
        $this->assertSame(2, $stats[3]);
        $this->assertSame(2, $stats[4]);
        $this->assertSame(1, $stats[5]);
        $this->assertSame(1, $stats[6]);
        $this->assertSame(1, $stats[7]);
        $this->assertSame(1, $stats[7]);
        $this->assertSame(1, $stats[9]);
    }

    public function createBoard()
    {
        $board = new Board(4);
        // ALSO
        // R.O.
        // S.WI
        // E..N
        $this->addCell($board, 1, 'A', 0, 0); 
        $this->addCell($board, 2, 'L', 1, 0); 
        $this->addCell($board, 3, 'S', 2, 0); 
        $this->addCell($board, 4, 'O', 3, 0); 

        $this->addCell($board, 5, 'R', 0, 1); 
        $this->addCell($board, 0, '',  1, 1); 
        $this->addCell($board, 4, 'O', 2, 1); 
        $this->addCell($board, 0, '',  3, 1); 

        $this->addCell($board, 3, 'S', 0, 2); 
        $this->addCell($board, 0, '',  1, 2); 
        $this->addCell($board, 6, 'W', 2, 2); 
        $this->addCell($board, 7, 'I', 3, 2); 

        $this->addCell($board, 8, 'E', 0, 3); 
        $this->addCell($board, 0, '',  1, 3); 
        $this->addCell($board, 0, '',  2, 3); 
        $this->addCell($board, 9, 'N', 3, 3); 
        
        return $board;
    }
}

