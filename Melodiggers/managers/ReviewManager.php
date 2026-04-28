<?php

namespace managers;

use managers\AbstractManager;
use models\Review;
use PDO;

class ReviewManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createReview(Review $review): bool
    {
        $query = $this->db->prepare("INSERT INTO reviews (id, user, album, title, content, created_at) VALUES (NULL, :user, :album, :title, :content, :created_at)");
        $parameters = [
            ":user" => $review->getUser()->getId(),
            ":album" => $review->getAlbum()->getId(),
            ":title" => $review->getTitle(),
            ":content" => $review->getContent(),
            ":created_at" => $review->getCreatedAt()
        ];
        $query->execute($parameters);
        if($this->db->lastInsertId()){
            return true;
        }
        return false;
    }

    public function findOne(int $id): ?Review
    {
        $query = $this->db->prepare("SELECT * FROM reviews WHERE id = :id");
        $parameters = [
            ":id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result){
            $um = new UserManager();
            $user = $um->findOne($result['user']);
            $am = new AlbumManager();
            $album = $am->findOne($result['album']);
            $review = new Review($user, $album, $result['title'], $result['content'], $result['created_at']);
            return $review;
        }
        return null;
    }

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM reviews");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $reviews = [];
        if($results){
            foreach($results as $result){
                $um = new UserManager();
                $user = $um->findOne($result['user']);
                $am = new AlbumManager();
                $album = $am->findOne($result['album']);
                $review = new Review($user, $result['album'], $result['title'], $result['content'], $result['created_at']);
                $reviews[] = $review;
            }
            return $reviews;
        }
        return [];
    }

    public function deleteReview(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM reviews WHERE id = :id");
        $parameters = [
            ":id" => $id
        ];
        $query->execute($parameters);
        return true;
    }


}