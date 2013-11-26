<?php
require_once(__DIR__ . '/BaseTest.php');
require_once(__DIR__ . '/RuleTest.php');

use Codewords\Solver\FollowedByRule;

/**
* @group unit
*/
class FollowedByTest extends RuleTest
{
    public function testCellThatHasFollowerPassesRule()
    {
        $rule = new FollowedByRule($this->board, $this->stats_repository, 1);
        $result = 1;
        $this->givenAStatObject($result);    

        $passes = $rule->passes($this->cell);
        $this->assertTrue($passes, 'Expected rule to pass');
    }

    public function testCellThatHasManyFollowersFailsRule()
    {
        $rule = new FollowedByRule($this->board, $this->stats_repository, 2);
        $result = 3;
        $this->givenAStatObject($result);    
        
        $passes = $rule->passes($this->cell);
        $this->assertFalse($passes, 'Expected rule to fail');
    }
}
