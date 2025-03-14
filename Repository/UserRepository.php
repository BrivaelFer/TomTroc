<?php

class UserRepository extends AbstractRepository
{
    public function findUserById(int $id): User
    {
        $sql = "SELECT * FROM usr WHERE id = :id";

        $query = $this->connection->prepare($sql);
        $query->execute(['id'=> $id]);
        $resulte = $query->fetch();
        
        return new User($resulte);
    }
    public function addUser(User $user): int
    {
        $sql = "INSERT INTO usr (email, password, name) VALUE (:email, :pw, :name)";

        $query = $this->connection->prepare($sql);

        $query->execute([
            'email' => $user->getEmail(),
            'pw' => Tools::hash($user->getPassword()),
            'name' => $user->getName()
        ]);

        return $this->connection->lastInsertId();
    }
    public function findUserByEmail(string $email): ?User
    {
        $sql = "SELECT * FROM usr WHERE email = :email";

        $query = $this->connection->prepare($sql);
        $query->execute(['email'=> $email]);
        $resulte = $query->fetch();
        
        if($resulte)
        {
            return new User($resulte);
        }
        return null;
    }
}