<?php

namespace managers;

use managers\AbstractManager;
use models\Media;
use PDO;

class MediaManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createMedia(Media $media): bool
    {
        $query = $this->db->prepare("INSERT INTO media (id, url, alt, type) VALUES (:NULL, :url, :alt, :type)");
        $parameters = [
            'url' => $media->getUrl(),
            'alt' => $media->getAlt(),
            'type' => $media->getType(),
        ];
        $query->execute($parameters);
        if ($this->db->lastInsertId()) {
            return true;
        }
        return false;
    }

    public function findOne(int $id): ?Media
    {
        $query = $this->db->prepare("SELECT * FROM media WHERE id = :id");
        $parameters = [
            'id' => $id,
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result){
            $media=new Media($result['url'], $result['alt'], $result['type'], $result['id']);
            return $media;
        }
        return null;
    }

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM media");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $medias = [];
        foreach ($results as $result) {
            $media=new Media($result['url'], $result['alt'], $result['type'], $result['id']);
            $medias[] = $media;
        }
        return $medias;
    }

    public function updateMedia(Media $media): bool
    {
        $query = $this->db->prepare("UPDATE media SET url = :url, alt = :alt, type = :type WHERE id = :id");
        $parameters = [
            'url' => $media->getUrl(),
            'alt' => $media->getAlt(),
            'type' => $media->getType(),
            'id' => $media->getId(),
        ];
        $query->execute($parameters);
        if ($this->db->lastInsertId()) {
            return true;
        }
        return false;
    }
    public function deleteMedia(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM media WHERE id = :id");
        $parameters = [
            'id' => $id,
        ];
        $query->execute($parameters);
        return true;
    }
}