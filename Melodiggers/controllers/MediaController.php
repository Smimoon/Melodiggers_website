<?php

namespace controllers;

use controllers\AbstractController;
use managers\MediaManager;
use models\Artist;
use models\Media;

class MediaController extends AbstractController
{
    private MediaManager $mm;
    public function __construct()
    {
        $this-> mm = new MediaManager();
    }

    public function list() : void
    {
        $data = $this->mm->findAll();
        $this -> renderAdmin("media/listMedia", $data);
    }

    public function show(int $id) : void
    {
        $data = $this->mm->findOne($id);
        $this -> renderAdmin("media/showMedia", $data);
    }

    public function create() : void
    {
        $this->renderAdmin("media/createMedia", []);
    }

    public function checkCreate() : void
    {
        if(isset($_POST['url'], $_POST['alt'], $_POST['type'])) {
            $url = htmlspecialchars($_POST['url']);
            $alt = htmlspecialchars($_POST['alt']);
            $type = htmlspecialchars($_POST['type']);

            if(!empty(trim($url)) && !empty(trim($alt)) && !empty(trim($type))) {
                $media = new Media($url, $alt, $type);
                $this->mm->createMedia($media);
                $this->redirect("index.php?route=showMedia&media_id=" . $media->getId());
            }
            else{
                $_SESSION["error"] = "Champs manquants ou invalides";
                $this -> renderAdmin("media/createMedia", $_SESSION["error"]);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this -> renderAdmin("media/createMedia", $_SESSION["error"]);
        }
    }

    public function update(int $id) : void
    {
        $media = $this -> mm -> findone($id);
        $this -> renderAdmin("media/updateMedia", ["media" => $media]);
    }

    public function checkUpdate(int $id) : void
    {
        if(isset($_POST['url'], $_POST['alt'], $_POST['type'])) {
            $url = htmlspecialchars($_POST['url']);
            $alt = htmlspecialchars($_POST['alt']);
            $type = htmlspecialchars($_POST['type']);

            if(!empty(trim($url)) && !empty(trim($alt)) && !empty(trim($type))) {
                $media = New Media($url, $alt, $type);
                $media->setId($id);
                $this->mm->updateMedia($media);
                unset($_SESSION["error"]);
                $this->redirect("index.php?route=showMedia&media_id=" . $media->getId());
            }
            else{
                $_SESSION["error"] = "Champs manquants ou invalides";
                $this->redirect("index.php?route=updateMedia&media_id=".$id);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this->redirect("index.php?route=updateMedia&media_id=".$id);
        }
    }
    public function delete(int $id) : void
    {
        $this -> mm -> deleteMedia($id);
        $this -> redirect("index.php?route=listMedia");
    }
}