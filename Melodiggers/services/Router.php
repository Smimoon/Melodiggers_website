<?php

use controllers\AlbumController;
use controllers\ArtistController;
use controllers\MediaController;
use controllers\ReviewController;
use controllers\ScoreController;
use controllers\UserController;

class Router
    {
        private UserController $uc;
        private AlbumController $alc;
        private ArtistController $arc;
        private MediaController $mc;
        private ReviewController $rc;
        private ScoreController $sc;
        public function __construct()
        {
            $this->uc = new UserController();
            $this->alc = new AlbumController();
            $this->arc = new ArtistController();
            $this->mc = new MediaController();
            $this->rc = new ReviewController();
            $this->sc = new ScoreController();


        }

        public function handleRequest(array $get) : void
        {
            if(isset($get['route'])){
//              Router affichage Front
                if ($get['route'] === 'home') {
//                    TODO appel methode home du PageController
                }
                else if ($get['route'] === 'top-releases') {
//                    TODO appel methode topReleases du PageController
                }
                else if ($get['route'] === 'artists-list') {
//                    TODO appel methode artistsList du PageController
                }
                else if ($get['route'] === 'artist-details' && $get['artist_id']) {
//                    TODO appel methode showArtist du PageController
                }
                else if ($get['route'] === 'album-details' && $get['album_id']) {
//                    TODO appel methode showAlbum du PageController
                }

//              Router Inscription/Connexion
                else if ($get['route'] === 'user-registration') {
//                    TODO appel methode register du UserController
                }
                else if ($get['route'] === 'checkRegistration') {
//                    TODO appel méthode checkRegister du UserController
                }
                else if ($get['route'] === 'user-login') {
//                    TODO appel methode login du UserController
                }
                else if ($get['route'] === 'checkLogin'){
//                    TODO appel méthode checkLogin du UserController
                }

//              Router Admin users
                else if ($get['route'] === 'userList') {
                    $this->uc->list();
                }
                else if ($get['route'] === 'showUser' && isset($get['user_id'])) {
                    $this->uc->show($get['user_id']);
                }
                else if ($get['route'] === 'createUser') {
                    $this->uc->create();
                }
                else if ($get['route'] === 'checkCreateUser') {
                    $this->uc->checkCreate();
                }
                else if ($get['route'] === 'updateUser' && isset($get['user_id'])) {
                    $this->uc->update($get['user_id']);
                }
                else if($get['route'] === 'checkUpdateUser' && isset($get['user_id'])) {
                    $this->uc->checkUpdate($get['user_id']);
                }
                else if ($get['route'] === 'deleteUser' && isset($get['user_id'])) {
                    $this->uc->delete($get['user_id']);
                }

//                Router Admin Album
                else if ($get['route'] === 'albumList') {
                    $this->alc->list();
                }
                else if ($get['route'] === 'albumDetails' && $get['album_id']) {
                    $this->alc->show($get['album_id']);
                }
                else if ($get['route'] === 'createAlbum') {
                    $this->alc->create();
                }
                else if ($get['route'] === 'updateAlbum' && isset($get['album_id'])) {
                    $this->alc->update($get['album_id']);
                }
                else if ($get['route'] === 'deleteAlbum' && isset($get['album_id'])) {
                    $this->alc->delete($get['album_id']);
                }
            }
        }
    }