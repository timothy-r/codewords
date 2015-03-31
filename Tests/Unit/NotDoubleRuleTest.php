<?php
require_once(__DIR__ . '/RuleTest.php');

use Ace\Codewords\Solver\NotDoubleRule;

/**
* @group unit
*/
class NotDoubleTest extends RuleTest
{
    protected $rule;

    public function setUp()
    {
        parent::setUp();
        $this->rule = new NotDoubleRule($this->stats_repository);
    }

    public function testCellThatHasNoDoublesPassesRule()
    {
        $result = 0;
        $this->givenAStatObject($result);    

        $passes = $this->rule->passes($this->cell);
        $this->assertTrue($passes, 'Expected rule to pass');
    }

    public function testCellThatHasDoublesFailsRule()
    {
        $result = 3;
        $this->givenAStatObject($result);    
        
        $passes = $this->rule->passes($this->cell);
        $this->assertFalse($passes, 'Expected rule to fail');
    }
}
