<?php

namespace controllers;

use controllers\AbstractController;
use managers\ScoreManager;
use models\Media;
use models\Score;

class ScoreController extends AbstractController
{
    private ScoreManager $sm;
    public function __construct()
    {
        $this-> sm = new ScoreManager();
    }

    public function list() : void
    {
        $data = $this->sm->findAll();
        $this -> renderAdmin("score/listScore.phtml", $data);
    }

    public function show(int $id) : void
    {
        $data = $this->sm->findOne($id);
        $this -> renderAdmin("score/showScore.phtml", $data);
    }

    public function create() : void
    {
        $this->renderAdmin("score/createScore.phtml", []);
    }

    public function checkCreate() : void
    {
        if(isset($_POST['album'], $_POST['globalScore'], $_POST['fanScore'])) {
            $album = $_POST['album']->getId();
            $globalScore = htmlspecialchars($_POST['globalScore']);
            $fanScore = htmlspecialchars($_POST['fanscore']);

            if(!empty(trim($album)) && !empty(trim($globalScore)) || !empty(trim($fanScore))) {
                $score = new Score($album, $globalScore, $fanScore);
                $this->sm->createScore($score);
                $this->redirect("index.php?route=showAlbum&album_id=" . $album);
            }
            else{
                $_SESSION["error"] = "Champs manquants ou invalides";
                $this -> renderAdmin("score/createScore", $_SESSION["error"]);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this -> renderAdmin("score/createScore", $_SESSION["error"]);
        }
    }

    public function update(int $id) : void
    {
        $score = $this -> sm -> findone($id);
        $this -> renderAdmin("score/updateScore", ["score" => $score]);
    }

    public function checkUpdate(int $id) : void
    {
        if(isset($_POST['album'], $_POST['globalScore'], $_POST['fanScore'])) {
            $album = $_POST['album']->getId();
            $globalScore = htmlspecialchars($_POST['globalScore']);
            $fanScore = htmlspecialchars($_POST['fanscore']);

            if(!empty(trim($album)) && !empty(trim($globalScore)) && !empty(trim($fanScore))) {
                $score = New Score($album, $globalScore, $fanScore);
                $score->setId($id);
                $this->sm->updateScore($score);
                unset($_SESSION["error"]);
                $this->redirect("index.php?route=showAlbum&album_id=" . $album);
            }
            else{
                $_SESSION["error"] = "Champs manquants ou invalides";
                $this->redirect("index.php?route=updateScore&score_id=".$id);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this->redirect("index.php?route=updateScore&score_id=".$id);
        }
    }
    public function delete(int $id) : void
    {
        $this -> sm -> delete($id);
        $this -> redirect("index.php?route=listScore");
    }
}