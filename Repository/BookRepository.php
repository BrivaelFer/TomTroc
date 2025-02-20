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
}
