<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Board\Cell;

/**
* Tests if a Cell appears as a double letter in any Word
*/
class NotDoubleRule
{
    protected $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function passes(Cell $cell)
    {
        $stats = $this->game->getStatsRepository()->getStat('DoubleLetter');
        $result = $stats->generateForCell($this->game, $cell);
        return count($result) === 0;
    }
}
