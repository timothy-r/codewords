<?php namespace Codewords\Dictionary;

use Codewords\DictionaryInterface;
use Doctrine\DBAL\Connection;

/**
* implements DictionaryInterface using an sql database as storage 
*/
class SqlDictionary implements DictionaryInterface
{
    /**
    * @var Doctrine\DBAL\Statement
    */
    protected $statement;

    public function __construct(Connection $connection)
    {   
        $sql = 'SELECT word from dictionary WHERE word REGEXP :pattern AND length = :length';
        $this->statement = $connection->prepare($sql);
    }

    /**
    * @return array of matching words
    */
    public function find($pattern, $length)
    {
        $this->statement->bindValue('pattern', $pattern);
        $this->statement->bindValue('length', $length);
        $this->statement->execute();
        $rows = $this->statement->fetchAll();
        
        $words = [];
        foreach ($rows as $row){
            $words []= $row[0];
        }
        
        return $words;
    }
}
