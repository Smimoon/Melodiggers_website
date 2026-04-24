<?php

namespace managers;

use managers\AbstractManager;
use models\User;
use PDO;

class UserManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createUser(User $user) : bool
    {
        $query = $this->db->prepare("INSERT INTO users (id, username, email, password, bio, badges) VALUES (NULL, :username, :email, :password, :bio, :badges)");
        $parameters = [
            "username" => $user->getUsername(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "bio" => $user->getBio(),
            "badges" => $user->getBadges()
        ];
        $query->execute($parameters);
        if ($this->db->lastInsertId()) {
            return true;
        }
        return false;
    }

    public function findOne(int $id) : ? User
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result){
            $user = new User($result["username"], $result["email"], $result["password"], $result["bio"], $result["badges"], $result["id"]);
            return $user;
        }
        return null;
    }

    public function findAll() : array
    {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $users = [];
        foreach ($results as $result) {
            $user = new User($result["username"], $result["email"], $result["password"], $result["bio"], $result["badges"], $result["id"]);
            $users[] = $user;
        }
        return $users;
    }

    public function updateUser(User $user) : bool
    {
    $query = $this->db->prepare("UPDATE users SET username=:username, email=:email, password=:password, bio=:bio, badges=:badges WHERE id=:id");
    $parameters = [
        "username" => $user->getUsername(),
        "email" => $user->getEmail(),
        "password" => $user->getPassword(),
        "bio" => $user->getBio(),
        "badges" => $user->getBadges(),
        "id" => $user->getId()
    ];
    $query->execute($parameters);
    return true;
    }
    public function deleteUser(int $id) : bool
    {
        $query = $this->db->prepare("DELETE FROM users WHERE id=:id");
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        return true;
    }
}

