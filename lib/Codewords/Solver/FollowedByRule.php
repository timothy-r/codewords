<?php namespace Codewords\Solver;

use Codewords\Stats\StatsRepository;
use Codewords\IRule;
use Codewords\Board\Cell;

/**
* Tests if a Cell is always followed by a single cell
*
* @todo inject Words not Board - or use Cell::getBoard() accessor?
*/
class FollowedByRule implements IRule
{
    protected $stats_repo;

    /**
    * @var integer number of acceptable following letters
    */
    protected $followers;

    public function __construct(StatsRepository $stats_repo, $followers)
    {
        $this->stats_repo = $stats_repo;
        $this->followers = $followers;
    }

    public function passes(Cell $cell)
    {
        $stats = $this->stats_repo->getStat('FollowingLetter');
        $result = $stats->generateForCell($cell);
        return count($result) <= $this->followers;
    }
}
