<?php namespace Codewords\Test;

trait AssertionTrait
{
    protected function assertIsCell($cell)
    {
        $this->assertInstanceOf('Codewords\Board\Cell', $cell);
    }
}
