<?php namespace Codewords\Solver;

use Codewords\Game;
use Codewords\Board\Cell;
use Codewords\Solver\FinderFactory;
use Codewords\Board\HtmlTableBoardRenderer;
use Timer\Clock;

/**
* Applies Finders to the Cells in a Game
* For a set of Letters it makes one pass and solves any that it can
*/
class CellOptions
{
    /**
    * @var Codewords\Game
    */
    protected $game;

    /**
    * @var Codewords\Solver\FinderFactory
    */
    protected $factory;

    protected $letters_to_cells = [];
    protected $cells_to_letters = [];

    public function __construct(Game $game, FinderFactory $factory)
    {
        $this->game = $game;
        $this->factory = $factory;
    }

    public function solveAll($letters)
    {
        // generate data on the values Cells could be
        // these should be refactored to separate classes?
        $this->letters_to_cells = [];
        $this->cells_to_letters = [];
        $clock = new Clock;
        foreach($letters as $letter){
            $clock->start();
            $finder = $this->factory->create($letter);
            $cells = $finder->solve($this->game);
            $this->letters_to_cells [$letter]= $cells;

            foreach($cells as $cell){
                if (!isset($this->cells_to_letters[$cell->getNumber()])){
                    $this->cells_to_letters[$cell->getNumber()] = [];
                }
                $this->cells_to_letters[$cell->getNumber()] []= $letter;
            }

            $numbers = array_map(function($cell){ return $cell->getNumber();}, $cells);
            #printf("Letter $letter took %f\n", $clock->stop());
            //printf("%s results %s\n", $letter, implode(',', $numbers));
        }
        
        $this->solveCellsWithOneLetter();
        $this->solveLettersWithOneCell();

        return $this->letters_to_cells;
    }

    /**
    * solve Cells that have a single possible Letter
    */
    protected function solveCellsWithOneLetter()
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
    
    /**
    * solve Letters that have a single possible Cell
    */
    protected function solveLettersWithOneCell()
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
        //print __METHOD__ . " Setting Cell {$cell->getNumber()} to $letter\n";
        $cell->setCharacter($letter);
        return;
        $renderer = new HtmlTableBoardRenderer;
        $file = 'results-' . $letter . '.html';
        file_put_contents($file, $renderer->render($this->game->getBoard()));
    }
}
