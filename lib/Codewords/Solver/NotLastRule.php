<?php namespace Codewords\Solver;

use Codewords\Stats\StatsRepository;
use Codewords\RuleInterface;
use Codewords\Board\Cell;

/**
* Tests if a Cell appears as the last letter in any Word
*/
class NotLastRule implements RuleInterface
{
    protected $stats_repo;

    public function __construct(StatsRepository $stats_repo)
    {
        $this->stats_repo = $stats_repo;
    }

    public function passes(Cell $cell)
    {
        $stats = $this->stats_repo->getStat('LastLetter');
        $result = $stats->generateForCell($cell);
        return $result === 0;
    }
}
