<?php namespace Codewords\Solver;

use Codewords\StrategyInterface;
use Codewords\Board\Cell;
use Codewords\Board\Board;
use Codewords\Solver\FinderFactory;
use Timer\Clock;

class StrategyB implements StrategyInterface
{
    protected $factory;
    protected $letters_to_cells = [];
    protected $cells_to_letters = [];

    public function __construct(FinderFactory $factory)
    {
        $this->factory = $factory;
    }

    public function solve(Board $board)
    {
        $letters = ['e','t','a','o','i','n','s','h','r','d','l','c','u','m','w','f','g','y','p','b','v','k','j','x','q','z'];
        $clock = new Clock;
        while (count($letters)) {
            $clock->start();
            $results = $this->solveAll($board, $letters);
            #printf("One iteration took %f\n", $clock->stop());
            $letters = array_keys($results);
        }
    }

    protected function solveAll(Board $board, $letters)
    {
        $this->board = $board;

        // generate data on the values Cells could be
        // these should be refactored to separate classes?
        $this->letters_to_cells = [];
        $this->cells_to_letters = [];
        $clock = new Clock;
        foreach($letters as $letter){
            $clock->start();
            $finder = $this->factory->create($this->board, $letter);
            $cells = $finder->solve($this->board);
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
        $cell_collection = $this->board->getCells();

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
        file_put_contents($file, $renderer->render($this->board));
    }
}
