<?php namespace Ace\Codewords\Test;

trait AssertionTrait
{
    protected function assertIsCell($cell)
    {
        $this->assertInstanceOf('Ace\Codewords\Board\Cell', $cell);
    }
}
