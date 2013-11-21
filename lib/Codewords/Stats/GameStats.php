<?php namespace Codewords\Stats;

use Codewords\IGameStats;
use Codewords\Game;
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

        for($i = 1; $i < $length+1; $i++){
            $cell = $cells->at($i);
            $this->counts[$cell->getNumber()] = $this->generateForCell($game, $cell);
        }

        return $this->counts;
    }

    public function generateForCell(Game $game, Cell $cell)
    {
        // use cached value if it exists
        if ($this->counts[$cell->getNumber()] !== null){
            return $this->counts[$cell->getNumber()];
        }
        return $this->doGenerateForCell($game, $cell);
    }

    abstract public function doGenerateForCell(Game $game, Cell $cell);
}

