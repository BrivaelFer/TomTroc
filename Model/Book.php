<?php


final class Book extends AbstractEntity
{
    private int $usrId;
    private string $title;
    private string $summary;
    private bool $dispo;
    private ?string $img;
    private string $author;

    public function getUsrId(): int 
    {
        return $this->usrId;
    }
    
    public function setUsrId(int $usrId): void 
    {
        $this->usrId = $usrId;
    }
    
    public function getTitle(): string 
    {
        return $this->title;
    }
    
    public function setTitle(string $title): void 
    {
        $this->title = $title;
    }
    
    public function getSummary(): string 
    {
        return $this->summary;
    }
    
    public function setSummary(string $summary): void 
    {
        Tools::removeTextarea($summary);
        $this->summary = $summary;
    }
    
    public function isDispo(): bool 
    {
        return $this->dispo;
    }
    
    public function setDispo(bool $dispo): void 
    {
        $this->dispo = $dispo;
    }
    
    public function getImg(): ?string 
    {
        return $this->img;
    }
    
    public function setImg(?string $img): void 
    {
        $this->img = $img;
    
    }
    public function getAuthor(): string
    {
        return $this->author;
    }
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }
}
