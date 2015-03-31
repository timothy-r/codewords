<?php
require_once(__DIR__ . '/RuleTest.php');

use Ace\Codewords\Solver\NotLastRule;
use Ace\Codewords\Test\UnitFixtureTrait;

/**
* @group unit
*/
class NotLastTest extends RuleTest
{
    protected $rule;

    public function setUp()
    {
        parent::setUp();
        $this->rule = new NotLastRule($this->stats_repository);
    }

    public function testCellThatHasNoLastsPassesRule()
    {
        $result = 0;
        $this->givenAStatObject($result);    

        $passes = $this->rule->passes($this->cell);
        $this->assertTrue($passes, 'Expected rule to pass');
    }

    public function testCellThatHasLastsFailsRule()
    {
        $result = 3;
        $this->givenAStatObject($result);    
        
        $passes = $this->rule->passes($this->cell);
        $this->assertFalse($passes, 'Expected rule to fail');
    }
}
