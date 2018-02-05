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
        $statement = $bdd->pdo->prepare( $sql );
        $response = $statement->execute([
            "username" => $this->username,
            "passwd" => $this->password
        ]);

        $status = [
            "success" => true,
            "error" => ""
        ];

        if ($response ) {

            $this->id = $bdd->pdo->lastInsertId();

        }

        else {

            $status = [

                "success" => false,
                "error" => $statement->errorInfo()

            ];
        }

        return $status;


    }

    function login(){

        $sql = "SELECT * FROM users WHERE username=:username AND password=:passwd";
        $bdd = new Bdd();
        $statement = $bdd->pdo->prepare( $sql );
        $statement->execute([
            "username" => $this->username,
            "passwd" => $this->password
        ]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            $_SESSION["user"] = $user;
            $status = [
                "success" => true,
                "error" => ""
            ];

        }

        else {

            $status = [

                "success" => false,
                "error" => $statement->errorInfo()

            ];
            
        }

        return $status;

    }

}