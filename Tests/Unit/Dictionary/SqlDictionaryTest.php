<?php

use Codewords\Dictionary\SqlDictionary;

/**
* @group unit
*/
class SqlDictionaryTest extends PHPUnit_Framework_TestCase
{

    protected $mock_statement;

    protected $mock_db_connection;

    public function testFindReturnsAllMatchingWords()
    {
        $this->givenAMockStatement();
        $this->givenAMockDbConnection();

        $pattern = '^.a.$';
        $length = 3;

        // set mock db expectations
        $this->mock_statement->expects($this->at(0))
            ->method('bindValue')
            ->with('pattern', $pattern);

        $this->mock_statement->expects($this->at(1))
            ->method('bindValue')
            ->with('length', $length);

        $this->mock_statement->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(0));

        $this->mock_statement->expects($this->any())
            ->method('fetchAll')
            ->will($this->returnValue([['cat'],['mat']]));

        $dictionary = new SqlDictionary($this->mock_db_connection);

        $result = $dictionary->find($pattern, $length);

        $this->assertTrue(is_array($result));
        $this->assertSame(2, count($result));
        $this->assertTrue(in_array('cat', $result));
        $this->assertTrue(in_array('mat', $result));
        
    }
    
    protected function givenAMockStatement()
    {
        $this->mock_statement = $this->getMockBuilder('Doctrine\DBAL\Statement')
            ->setMethods(['bindValue', 'execute', 'fetchAll'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function givenAMockDbConnection()
    {
        $this->mock_db_connection = $this->getMockBuilder('Doctrine\DBAL\Connection')
            ->setMethods(['prepare'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->mock_db_connection->expects($this->any())
            ->method('prepare')
            ->will($this->returnValue($this->mock_statement));
    }
}

