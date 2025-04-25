<?php

final class User extends AbstractEntity
{
    private string $email;
    private string $password;
    private string $name;
    private ?string $usrImg;
    private DateTime $creationDate;

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function setEmail(string $email): void 
    {
        $this->email = $email;
    }

    public function getPassword(): string 
    {
        return $this->password;
    }

    public function setPassword(string $password): void 
    {
        $this->password = $password;
    }

    public function getName(): string 
    {
        return $this->name;
    }

    public function setName(string $name): void 
    {
        $this->name = $name;
    }

    public function getUsrImg(): string|null 
    {
        return $this->usrImg;
    }

    public function setUsrImg(?string $usrImg): void 
    {
        $this->usrImg = $usrImg;
    }

    public function getCreationDate(): DateTime 
    {
        return $this->creationDate;
    }

    public function setCreationDate(string $creationDate): void 
    {
        $this->creationDate = new DateTime($creationDate);
    }
    public function getAccountAge(): string
    {
        $currentDate = new DateTime();
        $diff = $this->creationDate->diff($currentDate);
        
        if ($diff->y > 0) {
            return $diff->y . " an" . ($diff->y > 1 ? "s" : "");
        } elseif ($diff->m > 0) {
            return $diff->m . " mois";
        } elseif ($diff->d > 0) {
            return $diff->d . " jour" . ($diff->d > 1 ? "s" : "");
        } else {
            return "aujourd'hui";
        }
    }
}
