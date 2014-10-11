<?php
/**
* @todo put into a namespace or just use base PHPUnit class and traits
*/
use Codewords\Test\AssertionTrait;

abstract class IntegrationTest extends PHPUnit_Framework_TestCase
{
    use AssertionTrait;
}
