<?php

use Ace\Timer\Clock;

/**
* @group unit
*/
class ClockTest extends PHPUnit_Framework_TestCase
{
    public function testStartedClockHasPositiveElapsed()
    {
        $clock = new Clock;
        $clock->start();
        $result = $clock->elapsed();
        $this->assertTrue($result > 0);
        $result = $clock->elapsed();
        $this->assertTrue($result > 0);
    }

    public function testStartedClockHasPositiveStopTime()
    {
        $clock = new Clock;
        $clock->start();
        $result = $clock->stop();
        $this->assertTrue($result > 0);
    }

    public function testNotStartedClockHasNegativeElapsed()
    {
        $clock = new Clock;
        $result = $clock->elapsed();
        $this->assertSame(-1, $result);
    }

    public function testNotStartedClockHasNegativeStopTime()
    {
        $clock = new Clock;
        $result = $clock->stop();
        $this->assertSame(-1, $result);
    }

    public function testStoppedClockHasNegativeElapsed()
    {
        $clock = new Clock;
        $clock->start();
        $result = $clock->stop();
        $this->assertTrue($result > 0);
        $result = $clock->elapsed();
        $this->assertSame(-1, $result);
    }
}
