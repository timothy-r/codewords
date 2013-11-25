<?php namespace Codewords\Stats;

use Codewords\IGameStats;
use Codewords\Game;
use Codewords\Board\Board;
use Codewords\Board\Cell;

/**
* Generates count of when Letters are first letter in a Word
*/
abstract class GameStats implements IGameStats
{
    protected $counts;

    public function generate(Game $game)
    {
        if (!is_null($this->counts)){
            return $this->counts;
        }

        $cells = $game->getCells();
        $length = $cells->length();
        $this->counts = array_map(function($i){ return null;}, range(1,$length+1));
        unset($this->counts[0]);

        foreach($cells as $cell){
            $this->counts[$cell->getNumber()] = $this->generateForCell($game->getBoard(), $cell);
        }

        return $this->counts;
    }

    public function generateForCell(Board $board, Cell $cell)
    {
        // use cached value if it exists
        if ($this->counts[$cell->getNumber()] !== null){
            return $this->counts[$cell->getNumber()];
        }
        return $this->doGenerateForCell($board, $cell);
    }

    abstract public function doGenerateForCell(Board $board, Cell $cell);
}

