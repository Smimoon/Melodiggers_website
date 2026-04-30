<?php

namespace controllers;

use controllers\AbstractController;
use managers\UserManager;

class UserController extends AbstractController
{
    public function __construct()
    {
        $this-> um = new UserManager();
    }

    public function list() : void
    {
        $data = $this->um->findAll();
        $this -> renderAdmin("user/listUser.phtml", $data);
    }

    public function show(int $id) : void
    {
        $data = $this->um->findOne($id);
        $this -> renderAdmin("user/showUser.phtml", $data);
    }

    public function create() : void
    {
        $this->renderAdmin("user/createUser.phtml", []);
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

            if(!preg_match($regexEmail, $email) && !preg_match($regexPassword, $password) && !empty(trim($username) && !empty(trim($password)))) {
                $hashPassword = password_hash($password, PASSWORD_BCRYPT);
                $user = new User($username, $email, $hashPassword, $bio, $badges);
                $this->um->createUser($user);
                $this->redirect('admin/user/showUser');
            }
            else{
                $_SESSION["error"] = "Champs manquants";
                $this -> renderAdmin("_admin/user/createUser", $_SESSION["error"]);
            }
        }
        else{
            $_SESSION["error"] = "Champs manquants";
            $this -> renderAdmin("_admin/user/createUser", $_SESSION["error"]);
        }
    }

    public function update(int $id) : void
    {
        $user = $this -> um -> findone($id);
        $this -> renderAdmin("_admin/user/updateUser", ["user" => $user]);
    }

    public function checkUpdate(int $id) : void
    {
        if(isset($_POST['password'], $_POST['checkPassword'])){
            $password = $_POST['password'];
            $checkPassword = $_POST['checkPassword'];
            if($password === $checkPassword){
                $user = $this -> um -> findone($id);
                if($user!= NULL){
                    $hashPassword = password_hash($password, PASSWORD_BCRYPT);
                }
            }
        }
    }
    public function delete(int $id) : void
    {
        $this -> um -> deleteUser($id);
        $this -> redirect("index.php?route=listUsers");
    }
}