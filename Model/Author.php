<?php

class Author extends AbstractEntity
{
    private string $firstName;
    private string $name;
    private string $pseudo;

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }

    // Getter et Setter pour name
    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    // Getter et Setter pour pseudo
    public function getPseudo(): string {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): void {
        $this->pseudo = $pseudo;
    }

    public function getPseudoOrName(): string
    {
        return $this->pseudo ?? ($this->firstName . ' ' . $this->name);
    }
}