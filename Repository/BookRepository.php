<?php

final class BookRepository extends AbstractRepository
{
    public function findAllBooks(array $params = []): array
    {
        $sql = "SELECT * FROM book";

        if(isset($params['filters']))
        {
            $sql .= $this->generatFilterQuery($params['filters']);
        }

        if(isset($params['orders']))
        {
            $sql .= $this->generatOrderQuery($params['orders']);
        }
        if(isset($params['limit']))
        {
            $sql .= $this->generatLimitQuery($params['limit']);
        }

        $query = $this->connection->prepare($sql);

        if(isset($params['filters']))
        {
            $query->execute($params['filters']);
        }
        else $query->execute();

        $books = [];
        foreach($query->fetchAll() as $book)
        {
            $books[] = new Book($book);
        }
        return $books;
    }
    public function findBooksByUser(int $userId): array
    {
        $sql = "SELECT * FROM book WHERE usr_id = :userId";
        
        $query = $this->connection->prepare($sql);
        $query->execute(['userId' => $userId]);
       
        foreach($query->fetchAll() as $book)
        {
            $books[] = new Book($book);
        }
        return $books;
    }
}
