<?php

namespace controllers;

abstract class AbstractController
{
    protected function renderAdmin(string $template, array $data = []) : void
    {
        require "templates/admin/layout.phtml";
    }

    protected function renderFront(string $template, array $data) : void
    {
        require "templates/front/layout.phtml";
    }

    protected function redirect(string $route) : void
    {
        header("Location: $route");
    }
}