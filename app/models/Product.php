<?php
    class cookies {
        public $nom ;
        public $description ;
        public $prix ;
        public $image ;
        public $quantite;

        function listCookies(){
            require_once ('Database.php');
            $cnx=new connexion();
            $db=$cnx->CNXbase();
            $req="select * from cookies where quantite > 0";
            $res=$db->query($req) or print_r($db->errorInfo());
            return $res;
        }

        function getCookieById($id){
            require_once ('Database.php');
            $cnx=new connexion();
            $db=$cnx->CNXbase();
            $req="select * from cookies where id = :id";
            $res=$db->query($req) or print_r($db->errorInfo());
            return $res;
        }

    }

?>