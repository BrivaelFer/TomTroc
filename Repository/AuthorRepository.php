<?php

final class AuthorRepository extends AbstractRepository
{
    public function findAll(): array
    {
        $sql = "SELECT * FROM author";
        $query = $this->connection->prepare($sql);
        $query->execute();
        $authors = [];
        foreach ($query->fetchAll() as $value) {
            $authors[] = new Author($value);
        }
        return $authors;
    }

    public function findAuthorByBookId(int $bookId): array
    {
        $sql = "SELECT a.* FROM author AS a 
        INNER JOIN book_author AS ba ON ba.author_id = a.id 
        WHERE ba.book_id = :id";
        
        $query = $this->connection->prepare($sql);
        $query->execute(['id'=> $bookId]);
        $authors = [];
        foreach($query->fetchAll() as $author)
        {
            $authors[$author['id']] = new Author($author);
        }
        return $authors;
    }
}