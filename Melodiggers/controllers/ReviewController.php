<?php

namespace controllers;

use controllers\AbstractController;
use DateTime;
use managers\ReviewManager;
use models\Review;

class ReviewController extends AbstractController
{
    private ReviewManager $rm;
    public function __construct()
    {
        $this-> rm = new ReviewManager();
    }

    public function list() : void
    {
        $data = $this->rm->findAll();
        $this -> renderAdmin("review/listReview.phtml", $data);
    }

    public function show(int $id) : void
    {
        $data = $this->rm->findOne($id);
        $this -> renderAdmin("review/showReview.phtml", $data);
    }

    public function create() : void
    {
        $this->renderAdmin("review/createReview.phtml", []);
    }

    public function checkCreate() : void
    {
        if(isset($_POST['user'], $_POST['album'], $_POST['title'], $_POST['content'], $_POST['createdAt'])) {
            $user = $_POST['user']->getId();
            $album = $_POST['album']->getId();
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $createdAt = htmlspecialchars($_POST['createdAt']);

            if(!empty(trim($user)) && !empty(trim($album)) && !empty(trim($title)) && !empty(trim($content)) && !empty(trim($createdAt))) {
                $review = new Review($user, $album, $title, $content, DateTime::createFromFormat('Y-m-d H:i:s', $createdAt));
                $this->rm->createReview($review);
                $this->redirect("index.php?route=showReview&review_id=" . $review->getId());
            }
            else{
                $_SESSION["error"] = "Champs manquants ou invalides";
                $this -> renderAdmin("review/createReview", $_SESSION["error"]);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this -> renderAdmin("review/createReview", $_SESSION["error"]);
        }
    }

    public function update(int $id) : void
    {
        $review = $this -> rm -> findone($id);
        $this -> renderAdmin("review/updateReview", ["review" => $review]);
    }

    public function checkUpdate(int $id) : void
    {
        if(isset($_POST['user'], $_POST['album'], $_POST['title'], $_POST['content'], $_POST['createdAt'])) {
            $user = $_POST['user']->getId();
            $album = $_POST['album']->getId();
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $createdAt = htmlspecialchars($_POST['createdAt']);

            if(!empty(trim($user)) && !empty(trim($album)) && !empty(trim($title)) && !empty(trim($content)) && !empty(trim($createdAt))) {
                $review = New Review($user, $album, $title, $content, DateTime::createFromFormat('Y-m-d H:i:s', $createdAt));
                $review->setId($id);
                $this->rm->updateReview($review);
                unset($_SESSION["error"]);
                $this->redirect("index.php?route=showReview&review_id=" . $review->getId());
            }
            else{
                $_SESSION["error"] = "Champs manquants ou invalides";
                $this->redirect("index.php?route=updateReview&review_id=".$id);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this->redirect("index.php?route=updateReview&review_id=".$id);
        }
    }
    public function delete(int $id) : void
    {
        $this -> rm -> deleteReview($id);
        $this -> redirect("index.php?route=listReview");
    }
}