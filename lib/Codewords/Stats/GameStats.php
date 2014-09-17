<?php namespace Codewords\Stats;

use Codewords\IGameStats;
use Codewords\Board\Board;
use Codewords\Board\Cell;

/**
* Generates count of when Letters are first letter in a Word
*/
abstract class GameStats implements IGameStats
{
    protected $counts;

    public function generate(Board $board)
    {
        if (!is_null($this->counts)){
            return $this->counts;
        }

        $cells = $board->getCells();
        $length = $cells->length();
        $this->counts = array_map(function($i){ return null;}, range(1,$length+1));
        unset($this->counts[0]);

        foreach($cells as $cell){
            $this->counts[$cell->getNumber()] = $this->generateForCell($cell);
        }

        return $this->counts;
    }

    public function generateForCell(Cell $cell)
    {
        // use cached value if it exists
        if ($this->counts[$cell->getNumber()] !== null){
            return $this->counts[$cell->getNumber()];
        }
        return $this->doGenerateForCell($cell);
    }

    abstract protected function doGenerateForCell(Cell $cell);
}

