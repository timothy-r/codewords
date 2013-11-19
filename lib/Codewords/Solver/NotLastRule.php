<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Board\Cell;

/**
* Tests if a Cell appears as the last letter in any Word
*/
class NotLastRule
{
    protected $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function passes(Cell $cell)
    {
        $stats = $this->game->getStatsRepository()->getStat('LastLetter');
        $result = $stats->generateForCell($this->game, $cell);
        return count($result) === 0;
    }
}
