<?php namespace Codewords;

use Codewords\Game;
use Codewords\Board\Cell;
use Codewords\Solver\FinderFactory;
use Codewords\Board\HtmlTableBoardRenderer;

class CellOptions
{
    protected $game;
    
    protected $letters_to_cells = [];
    protected $cells_to_letters = [];

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function solveAll($letters)
    {
        $factory = new FinderFactory($this->game);
        $this->letters_to_cells = [];
        $this->cells_to_letters = [];

        foreach($letters as $letter){
            $finder = $factory->create($letter);
            $cells = $finder->solve($this->game);
            $this->letters_to_cells [$letter]= $cells;

            foreach($cells as $cell){
                if (!isset($this->cells_to_letters[$cell->getNumber()])){
                    $this->cells_to_letters[$cell->getNumber()] = [];
                }
                $this->cells_to_letters[$cell->getNumber()] []= $letter;
            }

            $numbers = array_map(function($cell){ return $cell->getNumber();}, $cells);
            printf("%s results %s\n", $letter, implode(',', $numbers));
        }

        $this->setUniqueCells();
        $this->setSingleOptionCells();
        return $this->letters_to_cells;
    }

    protected function setUniqueCells()
    {
        $cell_collection = $this->game->getCells();

        foreach($this->cells_to_letters as $index => $letters){
            if (count($letters) === 1){
                $letter = current($letters);

                $this->setCellCharacter($cell_collection->at($index), $letter);
                //$cell_collection->at($index)->setCharacter($letter); 
                // remove item from letters_to_cells
                unset($this->letters_to_cells[$letter]);

                // remove this cell's number from the other items in letters_to_cells
                foreach($this->letters_to_cells as $letter => &$cells){
                    // remove index from $cells
                    $cells = array_filter($cells, function($cell) use ($index){return $cell->getNumber() != $index;});
                }
            }
        }
    }

    protected function setSingleOptionCells()
    {
        $clear = [];

        foreach($this->letters_to_cells as $letter => $cells){
            if (count($cells) == 1){
                $cell = current($cells);
                //print __METHOD__ . " Setting Cell {$cell->getNumber()} to {$letter}\n";
                $this->setCellCharacter($cell, $letter);
                $clear []= $letter;
            }
        }

        // remove items here
        foreach ($clear as $letter){
            unset($this->letters_to_cells[$letter]);
        }
    }

    protected function setCellCharacter(Cell $cell, $letter)
    {
        print __METHOD__ . " Setting Cell {$cell->getNumber()} to $letter\n";
        $cell->setCharacter($letter);
        $renderer = new HtmlTableBoardRenderer;
        $file = 'results-' . $letter . '.html';
       // file_put_contents($file, $renderer->render($this->game->getBoard()));
    }
}
