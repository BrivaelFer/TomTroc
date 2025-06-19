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

    public function insertMessage(Message $message): void
    {
        $sql = 'INSERT INTO `message` (writer_id, reader_id, `content`) VALUE (:writerId, :readerId, :content)';
        
        $query = $this->connection->prepare($sql);
        $query->execute([
            'writerId' => $message->getWriterId(),
            'readerId' => $message->getReaderId(),
            'content' => $message->getContent()
        ]);
    }
    public function updateMessageToRead($readerId):void
    {
        $sql = 'UPDATE `message` SET is_read=true WHERE reader_id = :readerId';
        
        $query = $this->connection->prepare($sql);
        $query->execute(['readerId' => $readerId]);
    }
    public function countMessageUnread($readerId): int
    {
        $sql = 'SELECT COUNT(*) FROM `message` WHERE is_read = false AND reader_id = :readerId';

        $query = $this->connection->prepare($sql);
        $query->execute(['readerId' => $readerId]);

        $r = $query->fetch()[0];
        
        return $r;
    }
}