<?php

class MessageRepository extends AbstractRepository
{
    public function findByUser($id): array
    {
        $sql = 'SELECT * FROM `message` WHERE writer_id = :id OR reader_id = :id';

        $query = $this->connection->prepare($sql);
        $query->execute(['id' => $id]);

        $messages = [];
        foreach($query->fetchAll() as $message)
        {
            $messages[] = new Message($message);
        }
        return $messages;
    }

    public function insertMessage($writerId, $readerId, $content): void
    {
        $sql = 'INSERT INTO `message` (writer_id, reader_id, `content`) VALUE (:writerId, :readerId, :content)';
        
        $query = $this->connection->prepare($sql);
        $query->execute([
            'writerId' => $writerId,
            'readerId' => $readerId,
            'content' => $content
        ]);
    }
}