<?php namespace Codewords\Solver;

use Codewords\Board\Board;
use Codewords\Stats\StatsRepository;
use Codewords\RuleInterface;
use Codewords\Board\Cell;

/**
* Tests if a Cell appears as a double letter in any Word
*
* @todo inject stats instance or stats repo
* @todo inject Words not Game
*/
class NotDoubleRule implements RuleInterface
{
    protected $stats_repo;

    public function __construct(StatsRepository $stats_repo)
    {
        $this->stats_repo = $stats_repo;
    }

    public function passes(Cell $cell)
    {
        $stats = $this->stats_repo->getStat('DoubleLetter');
        $result = $stats->generateForCell($cell);
        return $result === 0;
    }
}
