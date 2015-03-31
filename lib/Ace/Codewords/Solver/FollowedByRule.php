<?php namespace Ace\Codewords\Solver;

use Ace\Codewords\Stats\StatsRepository;
use Ace\Codewords\RuleInterface;
use Ace\Codewords\Board\Cell;

/**
* Tests if a Cell is always followed by a single cell
*
* @todo inject Words not Board - or use Cell::getBoard() accessor?
*/
class FollowedByRule implements RuleInterface
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
