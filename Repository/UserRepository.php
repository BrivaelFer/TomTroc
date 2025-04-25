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
    public function updateUser(User $user, bool $skipPw = false): void
    {
        $sql = "UPDATE usr SET ";

        $oldUser = $this->findUserById($user->getId());
        $execVals = [];
        $execVals['id'] = $user->getId();
        $valSql = [];
        if ($oldUser->getName() != $user->getName()) {
            $valSql[] = "name = :name";
            $execVals['name'] = $user->getName();
        }
        
        if (!$skipPw && !Tools::comparePassword($user->getPassword(), $oldUser->getPassword())) {
            $valSql[] = "password = :password";
            $execVals['password'] = Tools::hash($user->getPassword());
        }
        
        if ($oldUser->getEmail() != $user->getEmail()) {
            $valSql[] = "email = :email";
            $execVals['email'] = $user->getEmail();
        }
        
        if ($oldUser->getUsrImg() != $user->getUsrImg()) {
            $valSql[] = "usr_img = :usr_img";
            $execVals['usr_img'] = $user->getUsrImg();
        }
        if(count($valSql) > 0)
        {
            $sql .= implode(", ", $valSql) . ' WHERE id = :id';
        
            $query = $this->connection->prepare($sql);
            $query->execute($execVals);
        }
        
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