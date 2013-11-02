<?php
require_once(__DIR__ . '/IntegrationTest.php');

use Codewords\Game;

/**
* @group integration
*/
class GameTest extends IntegrationTest
{
    protected $data_13 = 
"1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13\n1,2,3,4,5,6,7,8,9,10,11,12,13";

    public function testMakeGame()
    {
        $game = new Game($this->getFixture('data-1.csv'));

        $board = $game->getBoard();
        $this->assertInstanceOf('Codewords\Board', $board);

        $cells = $game->getCells();
        $this->assertInstanceOf('Codewords\CellCollection', $cells);
    }
}
