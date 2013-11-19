<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Board\Cell;
use Codewords\Stats\StatsRepository;

/**
* Finds Cells that may be an specified letter
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
