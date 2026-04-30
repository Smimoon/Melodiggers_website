<?php

namespace managers;

use managers\AbstractManager;
use models\Album;
use models\Score;
use PDO;

class ScoreManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createScore(Score $score) : bool
    {
        $query = $this->db->prepare("INSERT INTO scores (id,album, global_score, fan_score) VALUES (NULL,:album, :global_score, :fan_score)");
        $parameters = [
          'album'=>$score->getAlbum()->getId(),
          'global_score'=>$score->getGlobalScore(),
          'fan_score'=>$score->getFanScore()
        ];
        $query->execute($parameters);
        if($this->db->lastInsertId()){
            return true;
        }
        return false;
    }

    public function updateScore(Score $score) : bool
    {
        $query = $this->db->prepare('UPDATE scores SET global_score = :global_score, fan_score = :fan_score WHERE id = :id');
        $parameters = [
            'global_score'=>$score->getGlobalScore(),
            'fan_score'=>$score->getFanScore(),
            'id'=>$score->getId()
        ];
        $query->execute($parameters);
        return true;
    }
    public function findOne(int $id): ?Score
    {
        $query = $this->db->prepare("SELECT * FROM scores WHERE id = :id");
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result){
            $am = new AlbumManager();
            $album = $am->findOne($result["album"]);
            $score = new Score($album, $result["global_score"], $result["fan_score"], $result["id"]);
            return $score;
        }
        return null;
    }

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM scores");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $scores = [];
        foreach($results as $result){
            $am = new AlbumManager();
            $album = $am->findOne($result["album"]);
            $score = new Score($album, $result["global_score"], $result["fan_score"], $result["id"]);
            $scores[] = $score;
        }
        return $scores;
    }

    public function findScoreByAlbum (int $albumId): ? Score
    {
        $query = $this->db->prepare("SELECT * FROM scores JOIN albums ON albums.id = scores.album WHERE albums.id = :id");
        $parameters = [
            "id" => $albumId
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result){
            $am = new AlbumManager();
            $album = $am->findOne($result["album"]);
            $score = new Score($album, $result["global_score"], $result["fan_score"], $result["id"]);
            return $score;
        }
        return null;
    }

    public function delete(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM scores WHERE id = :id");
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        return true;
    }
}