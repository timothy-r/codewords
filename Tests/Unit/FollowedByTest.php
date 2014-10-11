<?php
require_once(__DIR__ . '/RuleTest.php');

use Codewords\Solver\FollowedByRule;

/**
* @group unit
*/
class FollowedByTest extends RuleTest
{
    public function testCellThatHasSameFollowersPassesRule()
    {
        $rule = new FollowedByRule($this->stats_repository, 1);
        $result = [1];
        $this->givenAStatObject($result);    

        $passes = $rule->passes($this->cell);
        $this->assertTrue($passes, 'Expected rule to pass');
    }

    public function testCellThatHasLessFollowersPassesRule()
    {
        $rule = new FollowedByRule($this->stats_repository, 2);
        $result = [4];
        $this->givenAStatObject($result);    

        $passes = $rule->passes($this->cell);
        $this->assertTrue($passes, 'Expected rule to pass');
    }

    public function testCellThatHasMoreFollowersFailsRule()
    {
        $rule = new  FollowedByRule($this->stats_repository, 2);
        $result = [3,5,9];
        $this->givenAStatObject($result);    
        
        $passes = $rule->passes($this->cell);
        $this->assertFalse($passes, 'Expected rule to fail');
    }
}
