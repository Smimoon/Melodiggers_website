<?php
    require "vendor/autoload.php";
    require "config/autoload.php";
    session_start();
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $router = New Router();
    $router->handleRequest($_GET);