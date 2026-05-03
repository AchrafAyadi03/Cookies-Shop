<?php
    class cookies {
        public $id ;
        public $nom ;
        public $description ;
        public $prix ;
        public $image ;
        public $quantite;

        function listCookies(){
            require_once (__DIR__ . '/Database.php');
            $cnx=new connexion();
            $db=$cnx->CNXbase();
            $req="select * from cookies where quantite > 0";
            $res=$db->query($req) or print_r($db->errorInfo());
            return $res;
        }

        function getCookieById($id){
            require_once (__DIR__ . '/Database.php');
            $cnx=new connexion();
            $db=$cnx->CNXbase();
            $req="select * from cookies where id = '$id'";
            $req2="select * from ingredients where cookiesId = '$id'";
            $res=$db->query($req) or print_r($db->errorInfo());
            $cookie = $res->fetch(PDO::FETCH_ASSOC);
            $res2=$db->query($req2) or print_r($db->errorInfo());
            $ingredients = $res2->fetchAll(PDO::FETCH_ASSOC);
            $cookie['ingredient'] = $ingredients;
            return $cookie;
        }

    }

?>