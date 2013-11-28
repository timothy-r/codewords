<?php namespace Timer;

class Clock
{
    protected $start = 0;

    public function start()
    {
        $this->start = microtime(true);
    }

    public function stop()
    {
        $result = $this->elapsed();
        $this->start = 0;
        return $result;
    }

    public function elapsed()
    {
        if ($this->start){
            return microtime(true) - $this->start;
        } else {
            // not running
            return -1;
        }
    }
}
