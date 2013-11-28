<?php
require_once(__DIR__ . '/BaseTest.php');

use Timer\Clock;

/**
* @group unit
*/
class ClockTest extends BaseTest
{
    public function testClock()
    {
        $clock = new Clock;
        $clock->start();
        $result = $clock->stop();
        $this->assertTrue($result > 0);
    }
}
