<?php namespace Codewords\Solver;

use Codewords\Board\Board;
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
    protected $board;
    protected $stats_repo;

    /**
    * @var integer number of acceptable following letters
    */
    protected $followers;

    public function __construct(Board $board, StatsRepository $stats_repo, $followers)
    {
        $this->board = $board;
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
