<?php

namespace managers;

use managers\AbstractManager;
use models\Artist;

class ArtistManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createArtist(Artist $artist): bool
    {
        $query = $this->db->prepare("INSERT INTO artists (id, name, genre, active_period, bio) VALUES (NULL, :name, :genre, :active_period, :bio)");
        $parameters = [
            ':name' => $artist->getName(),
            ':genre' => $artist->getGenre(),
            ':active_period' => $artist->getActivePeriod(),
            ':bio' => $artist->getBio()
        ];
        $query->execute($parameters);
        if ($this->db->lastInsertId()) {
            return true;
        }
        return false;
    }
}