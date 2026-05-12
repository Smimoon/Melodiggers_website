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
                else if ($get['route'] === 'showAlbum' && $get['album_id']) {
                    $this->alc->show($get['album_id']);
                }
                else if ($get['route'] === 'createAlbum') {
                    $this->alc->create();
                }
                else if ($get['route'] === 'checkCreateAlbum') {
                    $this->alc->checkCreate();
                }
                else if ($get['route'] === 'updateAlbum' && isset($get['album_id'])) {
                    $this->alc->update($get['album_id']);
                }
                else if ($get['route'] === 'checkUpdateAlbum' && isset($get['album_id'])) {
                    $this->alc->checkUpdate($get['album_id']);
                }
                else if ($get['route'] === 'deleteAlbum' && isset($get['album_id'])) {
                    $this->alc->delete($get['album_id']);
                }

//                Router Admin Artist
                else if ($get['route'] === 'artistList') {
                    $this->arc->list();
                }
                else if ($get['route'] === 'showArtist' && $get['artist_id']) {
                    $this->arc->show($get['artist_id']);
                }
                else if ($get['route'] === 'createArtist') {
                    $this->arc->create();
                }
                else if ($get['route'] === 'checkCreateArtist') {
                    $this->arc->checkCreate();
                }
                else if ($get['route'] === 'updateArtist' && isset($get['artist_id'])) {
                    $this->arc->update($get['artist_id']);
                }
                else if ($get['route'] === 'checkUpdateArtist' && isset($get['artist_id'])) {
                    $this->arc->checkUpdate($get['artist_id']);
                }
                else if ($get['route'] === 'deleteArtist' && isset($get['artist_id'])) {
                    $this->arc->delete($get['artist_id']);
                }

//                Router Admin Media
                else if ($get['route'] === 'mediaList') {
                    $this->mc->list();
                }
                else if ($get['route'] === 'showMedia' && $get['media_id']) {
                    $this->mc->show($get['media_id']);
                }
                else if ($get['route'] === 'createMedia') {
                    $this->mc->create();
                }
                else if ($get['route'] === 'checkCreateMedia') {
                    $this->mc->checkCreate();
                }
                else if ($get['route'] === 'updateMedia' && isset($get['media_id'])) {
                    $this->mc->update($get['media_id']);
                }
                else if ($get['route'] === 'checkUpdateMedia' && isset($get['media_id'])) {
                    $this->mc->checkUpdate($get['media_id']);
                }
                else if ($get['route'] === 'deleteMedia' && isset($get['media_id'])) {
                    $this->mc->delete($get['media_id']);
                }

//                Router Admin Review
                else if ($get['route'] === 'reviewList') {
                    $this->rc->list();
                }
                else if ($get['route'] === 'showReview' && $get['review_id']) {
                    $this->rc->show($get['review_id']);
                }
                else if ($get['route'] === 'createReview') {
                    $this->rc->create();
                }
                else if ($get['route'] === 'checkCreateReview') {
                    $this->rc->checkCreate();
                }
                else if ($get['route'] === 'updateReview' && isset($get['review_id'])) {
                    $this->rc->update($get['review_id']);
                }
                else if ($get['route'] === 'checkUpdateReview' && isset($get['review_id'])) {
                    $this->rc->checkUpdate($get['review_id']);
                }
                else if ($get['route'] === 'deleteReview' && isset($get['review_id'])) {
                    $this->rc->delete($get['review_id']);
                }

//                Router Admin Score
                else if ($get['route'] === 'scoreList') {
                    $this->sc->list();
                }
                else if ($get['route'] === 'showScore' && $get['score_id']) {
                    $this->sc->show($get['score_id']);
                }
                else if ($get['route'] === 'createScore') {
                    $this->sc->create();
                }
                else if ($get['route'] === 'checkCreateScore') {
                    $this->sc->checkCreate();
                }
                else if ($get['route'] === 'updateScore' && isset($get['score_id'])) {
                    $this->sc->update($get['score_id']);
                }
                else if ($get['route'] === 'checkUpdateScore' && isset($get['score_id'])) {
                    $this->sc->checkUpdate($get['score_id']);
                }
                else if ($get['route'] === 'deleteScore' && isset($get['score_id'])) {
                    $this->sc->delete($get['score_id']);
                }
                else{
                    echo "Duper";
                }
            }
            else{
                $this->arc->list();
            }
        }
    }