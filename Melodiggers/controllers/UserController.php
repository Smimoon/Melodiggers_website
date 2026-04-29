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
        $this->renderAdmin("user/createUser.phtml");
    }

    public function delete(int $id) : void
    {
        $this -> um -> deleteUser($id);
        $this -> redirect("index.php?route=listUsers");
    }
}