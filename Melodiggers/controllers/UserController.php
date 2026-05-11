<?php

namespace controllers;

use controllers\AbstractController;
use managers\UserManager;

class UserController extends AbstractController
{
    private UserManager $um;
    public function __construct()
    {
        $this-> um = new UserManager();
    }

    public function list() : void
    {
        $data = $this->um->findAll();
        $this -> renderAdmin("user/listUser", $data);
    }

    public function show(int $id) : void
    {
        $data = $this->um->findOne($id);
        $this -> renderAdmin("user/showUser", $data);
    }

    public function create() : void
    {
        $this->renderAdmin("user/createUser", []);
    }

    public function checkCreate() : void
    {
        if(isset($_POST['username'], $_POST['email'], $_POST['password'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $bio = $_POST['bio'];
            $badges = $_POST['badges'];
            $regexEmail = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9._%+-]+\.[A-Za-z]{2,}$/';
            $regexPassword = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';

            if(preg_match($regexEmail, $email) && preg_match($regexPassword, $password) && !empty(trim($username) && !empty(trim($password)))) {
                $hashPassword = password_hash($password, PASSWORD_BCRYPT);
                $user = new User($username, $email, $hashPassword, $bio, $badges);
                $this->um->createUser($user);
                $this->redirect("index.php?route=showUser&user_id=" . $user->getId());
            }
            else{
                $_SESSION["error"] = "Champs manquants";
                $this -> renderAdmin("user/createUser", $_SESSION["error"]);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this -> renderAdmin("user/createUser", $_SESSION["error"]);
        }
    }

    public function update(int $id) : void
    {
        $user = $this -> um -> findone($id);
        $this -> renderAdmin("user/updateUser", ["user" => $user]);
    }

    public function checkUpdate(int $id) : void
    {
        if(isset($_POST['password'], $_POST['checkPassword'])){
            $password = $_POST['password'];
            $checkPassword = $_POST['checkPassword'];
            $regexPassword = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
            if(!empty(trim($password) && !empty(trim($checkPassword)))){
                if($password === $checkPassword && preg_match($regexPassword, $password)){
                    $user = $this -> um -> findone($id);
                    if($user!= NULL){
                        $hashPassword = password_hash($password, PASSWORD_BCRYPT);
                        $user->setPassword($hashPassword);
                        unset($_SESSION["error"]);
                        $this->redirect("index.php?route=showUser&user_id=" . $user->getId());
                    }
                    else{
                        $_SESSION["error"] = "Utilisateur introuvable";
                        $this -> redirect("index.php?route=updateUser&user_id=" . $id);
                    }
                }
                else{
                    $_SESSION["error"] = "Les mots de passe ne correspondent pas";
                    $this -> redirect("index.php?route=updateUser&user_id=" . $id);
                }
            }
            else{
                $_SESSION["error"] = "Champs manquants";
                $this -> redirect("index.php?route=updateUser&user_id=" . $id);
            }
        }
        else if(isset($_POST['username'], $_POST['email'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $bio = $_POST['bio'];
            $badges = $_POST['badges'];
            $regexEmail = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9._%+-]+\.[A-Za-z]{2,}$/';
            if(preg_match($regexEmail, $email)){
                if (!empty(trim($username)) && !empty(trim($email))){
                    $user = $this->um->findone($id);
                    $newUser = new User($username, $email, $user->getPassword(), $bio, $badges);
                    $newUser->setId($id);
                    $this->um->updateUser($newUser);
                    unset($_SESSION["error"]);
                    $this->redirect("index.php?route=showUser&user_id=" . $newUser->getId());
                }
                else{
                    $_SESSION["error"] = "Champs manquants";
                    $this -> redirect("index.php?route=updateUser&user_id=" . $id);
                }
            }
            else{
                $_SESSION["error"] = "Adresse email invalide";
                $this -> redirect("index.php?route=updateUser&user_id=" . $id);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this -> redirect("index.php?route=updateUser&user_id=" . $id);
        }
    }
    public function delete(int $id) : void
    {
        $this -> um -> deleteUser($id);
        $this -> redirect("index.php?route=listUsers");
    }
}