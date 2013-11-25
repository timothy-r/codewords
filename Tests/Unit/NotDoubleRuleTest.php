<?php
require_once(__DIR__ . '/BaseTest.php');
require_once(__DIR__ . '/RuleTest.php');

use Codewords\Solver\NotDoubleRule;

/**
* @group unit
*/
class NotDoubleTest extends RuleTest
{
    protected $rule;

    public function setUp()
    {
        parent::setUp();
        $this->rule = new NotDoubleRule($this->board, $this->stats_repository);
    }

    public function testCellThatHasNoDoublesPassesRule()
    {
        $result = [];
        $this->givenAStatObject($result);    

        $passes = $this->rule->passes($this->cell);
        $this->assertTrue($passes, 'Expected rule to pass');
    }

    public function testCellThatHasDoublesFailsRule()
    {
        $result = [2,4,5];
        $this->givenAStatObject($result);    
        
        $passes = $this->rule->passes($this->cell);
        $this->assertFalse($passes, 'Expected rule to fail');
    }
}
