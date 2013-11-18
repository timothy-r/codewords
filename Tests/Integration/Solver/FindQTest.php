<?php

require_once(__DIR__ . '/../IntegrationTest.php');
require_once(__DIR__. '/../FixtureTrait.php');

use Codewords\Solver\FindQ;

class FindQTest extends IntegrationTest
{
    use FixtureTrait;

    public function getValidGameData()
    {
        return [
            ['data-1.csv', ['3']],
            // in data-3 Q is followed by I in IRAQI...
            //['data-3.csv', ['25']],
        ];
    }
    
    /**
    * @dataProvider getValidGameData
    */
    public function testSolveReturnsArrayOfCells($fixture, $expected)
    {
        $this->givenAFileDictionary();
        $this->givenAGame($fixture);

        // fill out the Cells already solved 
       // $this->game->getCells()->at(3)->setCharacter('I');
       // $this->game->getCells()->at(6)->setCharacter('P');
       // $this->game->getCells()->at(17)->setCharacter('N');

        $solver = new FindQ($this->game);
        $results = $solver->solve();
        
        //var_dump($results);

        $this->assertTrue(is_array($results), "Expected solve() to return an array");
        $this->assertSame(count($expected), count($results), "Expected solve() to return ".count($expected)." results");
        foreach($results as $cell) {
            $this->assertIsCell($cell);
            $this->assertTrue(in_array($cell->getNumber(), $expected), "Didn't expect " . $cell->getNumber() . " to be a possible Q");
        }
    }
}
