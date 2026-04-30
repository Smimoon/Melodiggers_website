<?php
    class Router
    {
        public function __construct()
        {

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
                else if ($get['route'] === 'user-list') {
//                    TODO appel methode list du UserController
                }
                else if ($get['route'] === 'showUser' && isset($get['user_id'])) {
//                    TODO appel methode show du UserController
                }

            }
        }
    }