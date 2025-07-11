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
    public function findBookById(int $id): ?Book
    {
        $book = null;
        $sql = "SELECT * FROM book WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([':id' => $id]);
        $r = $query->fetch();
        if($r)
            $book = new Book($r);
        return $book;
    }
    public function findBooksByUser(int $userId): array
    {
        $sql = "SELECT * FROM book WHERE usr_id = :userId";
        
        $query = $this->connection->prepare($sql);
        $query->execute(['userId' => $userId]);
       
        $books = [];
        foreach($query->fetchAll() as $book)
        {
            $books[] = new Book($book);
        }
        return $books;
    }
    public function insertBook(Book $book): int
    {
        $sql = 'INSERT INTO book (title, `usr_id`, summary, dispo, author) VALUE (:title, :userId, :summary, :dispo, :author)';

        $query = $this->connection->prepare($sql);
        $query->execute([
            'title' => $book->getTitle(),
            'userId' => $book->getUsrId(),
            'summary' => $book->getSummary(),
            'dispo' => $book->isDispo(),
            'author' => $book->getAuthor(),
        ]);

        return $this->connection->lastInsertId();
    }
    public function updateBook(Book $book): void
    {
        $sql = "UPDATE book SET ";

        $oldBook = $this->findBookById($book->getId());
        $execVals = [];
        $execVals['id'] = $book->getId();
        $valSql = [];
        if($oldBook->getTitle() != $book->getTitle()){
            $valSql[] = "title = :title";
            $execVals['title'] = $book->getTitle();
        }
        if($oldBook->getUsrId() != $book->getUsrId()) {
            $valSql[] = "usr_id = :usrId";
            $execVals['usrId'] = $book->getUsrId();
        }
        if($oldBook->getSummary() != $book->getSummary()) {
            $valSql[] = "summary = :summary";
            $execVals['summary'] = $book->getSummary();
        }
        if($oldBook->isDispo() != $book->isDispo()) {
            $valSql[] = "dispo = :dispo";
            $execVals['dispo'] = $book->isDispo();
        }
        if($oldBook->getImg() != $book->getImg()) {
            $valSql[] = "img = :img";
            $execVals['img'] = $book->getImg();
        }
        if($oldBook->getAuthor() != $book->getAuthor()) {
            $valSql[] = "author = :author";
            $execVals['author'] = $book->getAuthor();
        }
        if(count($valSql) > 0){
            $sql .= implode(", ", $valSql) . ' WHERE id = :id';

            $query = $this->connection->prepare($sql);
            $query->execute($execVals);
        }
    }
    public function deleteBook(int $id): void
    {
        $sql = "DELETE FROM book WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([':id' => $id]);
    }
}
