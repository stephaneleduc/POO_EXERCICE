<?php 
class User {

    private $id = 0;
    private $username = "";
    private $password = "";

    function __construct( $param_username, $param_password ){
        $this->username = $param_username;
        $this->password = $param_password;
    }

    function create(){

        $sql = "INSERT INTO users VALUES(null, :username, :passwd)";
        $bdd = new Bdd();
        $bdd->pdo->prepare( $sql );

    }

    function login(){

    }

}