<?php 
class Bdd {

    // Les constantes sont apellé avec self::
    const DSN = "mysql:dbname=note;host=localhost";
    const USER = "root";
    const PASSWORD = "root";

    public $pdo;

    function __construct(){

        try {
            $this->pdo = new PDO( self::DSN, self::USER, self::PASSWORD );
        }
        catch (PDOException $e){
            echo 'Connexion échouée : ' . $e->getMessage();
            die();
        }

    }

}

//