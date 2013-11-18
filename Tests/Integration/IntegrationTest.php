<?php

abstract class IntegrationTest extends PHPUnit_Framework_TestCase{

    protected function assertIsCell($cell)
    {
        $this->assertInstanceOf('Codewords\Board\Cell', $cell);
    }
}
