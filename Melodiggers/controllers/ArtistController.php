<?php

namespace controllers;

use controllers\AbstractController;
use DateTime;
use managers\ArtistManager;
use models\Album;
use models\Artist;

class ArtistController extends AbstractController
{
    private ArtistManager $arm;
    public function __construct()
    {
        $this->arm = New ArtistManager();
    }

    public function list() : void
    {
        $data = $this->arm->findAll();
        $this -> renderAdmin("artist/listArtist.phtml", $data);
    }

    public function show(int $id) : void
    {
        $data = $this->arm->findOne($id);
        $this -> renderAdmin("artist/showArtist.phtml", $data);
    }

    public function create() : void
    {
        $this->renderAdmin("artist/createArtist.phtml", []);
    }

    public function checkCreate() : void
    {
        if(isset($_POST['name'], $_POST['genre'], $_POST['createdAt'])) {
            $name = htmlspecialchars($_POST['name']);
            $genre = htmlspecialchars($_POST['genre']);
            $bio = htmlspecialchars($_POST['bio']);
            $createdAt = htmlspecialchars($_POST['createdAt']);

            if(!empty(trim($name)) && !empty(trim($genre)) && !empty(trim($createdAt))) {
                $artist = new Artist($name, $genre, $bio, Datetime::createFromFormat('d/m/Y', $createdAt));
                $this->arm->createArtist($artist);
                $this->redirect("index.php?route=showArtist&artist_id=" . $artist->getId());
            }
            else{
                $_SESSION["error"] = "Champs manquants ou invalides";
                $this -> renderAdmin("artist/createArtist", $_SESSION["error"]);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this -> renderAdmin("artist/createArtist", $_SESSION["error"]);
        }
    }

    public function update(int $id) : void
    {
        $artist = $this -> arm -> findone($id);
        $this -> renderAdmin("artist/updateArtist", ["artist" => $artist]);
    }

    public function checkUpdate(int $id) : void
    {
        if(isset($_POST['name'], $_POST['genre'], $_POST['createdAt'])) {
            $name = htmlspecialchars($_POST['name']);
            $genre = htmlspecialchars($_POST['genre']);
            $createdAt= htmlspecialchars($_POST['createdAt']);
            $bio = htmlspecialchars($_POST['bio']);

            if(!empty(trim($name)) && !empty(trim($genre)) && !empty(trim($createdAt))) {
                $artist = New Artist($name, $genre, $bio, DateTime::createFromFormat('d/m/Y', $createdAt) );
                $artist->setId($id);
                $this->arm->updateArtist($artist);
                unset($_SESSION["error"]);
                $this->redirect("index.php?route=showArtist&artist_id=" . $artist->getId());
            }
            else{
                $_SESSION["error"] = "Champs manquants ou invalides";
                $this->redirect("index.php?route=updateArtist&artist_id=".$id);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this->redirect("index.php?route=updateArtist&artist_id=".$id);
        }
    }
    public function delete(int $id) : void
    {
        $this -> arm -> deleteArtist($id);
        $this -> redirect("index.php?route=listArtist");
    }
}