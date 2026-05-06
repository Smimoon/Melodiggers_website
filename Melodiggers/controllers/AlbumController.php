<?php

namespace controllers;

use controllers\AbstractController;
use managers\AlbumManager;
use models\Album;

class AlbumController extends AbstractController
{
    private AlbumManager $am;
    public function __construct()
    {
        $this-> am = new AlbumManager();
    }

    public function list() : void
    {
        $data = $this->am->findAll();
        $this -> renderAdmin("album/listAlbum.phtml", $data);
    }

    public function show(int $id) : void
    {
        $data = $this->am->findOne($id);
        $this -> renderAdmin("album/showAlbum.phtml", $data);
    }

    public function create() : void
    {
        $this->renderAdmin("album/createAlbum.phtml", []);
    }

    public function checkCreate() : void
    {
        if(isset($_POST['name'], $_POST['genre'], $_POST['releaseDate'], $_POST['trackList'])) {
            $name = htmlspecialchars($_POST['name']);
            $genre = htmlspecialchars($_POST['genre']);
            $releaseDate = htmlspecialchars($_POST['releaseDate']);
            $trackList = htmlspecialchars($_POST['trackList']);

            if(!empty(trim($name)) && !empty(trim($genre)) && !empty(trim($releaseDate)) && !empty(trim($trackList))) {
                $album = new Album($name, $genre, $trackList, DateTime::createFromFormat('d/m/Y', $releaseDate));
                $this->am->createAlbum($album);
                $this->redirect("index.php?route=showAlbum&album_id=" . $album->getId());
            }
            else{
                $_SESSION["error"] = "Champs manquants ou invalides";
                $this -> renderAdmin("album/createAlbum", $_SESSION["error"]);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this -> renderAdmin("album/createAlbum", $_SESSION["error"]);
        }
    }

    public function update(int $id) : void
    {
        $album = $this -> am -> findone($id);
        $this -> renderAdmin("album/updateAlbum", ["album" => $album]);
    }

    public function checkUpdate(int $id) : void
    {
        if(isset($_POST['name'], $_POST['genre'], $_POST['releaseDate'], $_POST['trackList'])) {
            $name = htmlspecialchars($_POST['name']);
            $genre = htmlspecialchars($_POST['genre']);
            $releaseDate = htmlspecialchars($_POST['releaseDate']);
            $trackList = htmlspecialchars($_POST['trackList']);

            if(!empty(trim($name)) && !empty(trim($genre)) && !empty(trim($releaseDate)) && !empty(trim($trackList))) {
                $album = New Album($name, $genre, $trackList, DateTime::createFromFormat('d/m/Y', $releaseDate) );
                $album->setId($id);
                $this->am->updateAlbum($album);
                unset($_SESSION["error"]);
                $this->redirect("index.php?route=showAlbum&album_id=" . $album->getId());
            }
            else{
                $_SESSION["error"] = "Champs manquants ou invalides";
                $this->redirect("index.php?route=updateAlbum&album_id=".$id);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this->redirect("index.php?route=updateAlbum&album_id=".$id);
        }
    }

    public function delete(int $id) : void
    {
        $this->am->deleteAlbum($id);
        $this -> redirect("index.php?route=albumList");
    }
}