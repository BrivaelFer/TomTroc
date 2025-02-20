<?php

class Message extends AbstractEntity
{
    private int $writerId;
    private int $readerId;
    private string $content;
    private DateTime $publication;


    public function getWriterId(): int {
        return $this->writerId;
    }

    public function setWriterId(int $writerId): void {
        $this->writerId = $writerId;
    }

    public function getReaderId(): int {
        return $this->readerId;
    }

    public function setReaderId(int $readerId): void {
        $this->readerId = $readerId;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function getPublication(): DateTime {
        return $this->publication;
    }

    public function setPublication(string $publication): void {
        $this->publication = new DateTime($publication);
    }
}