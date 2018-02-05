<?php 
class Note {

    private $id = 0;
    private $id_user = 0;
    private $title = "";
    private $content = "";
    private $date = "";

    function __construct( $param_id_user, $param_title, $param_content ){
        $this->id_user = $param_id_user;
        $this->title = $param_title;
        $this->content = $param_content;
    }


    // function listNotes () {

    //     $sql = "SELECT * FROM notes";
    //     $bdd = new Bdd();
    //     $statement = $bdd->pdo->prepare( $sql );
    //     $statement->execute([
    //         "username" => $this->username,
    //         "passwd" => $this->password
    //     ]);

    //     $user = $statement->fetch(PDO::FETCH_ASSOC);

    // }


    function addNote() {

        $sql = "INSERT INTO notes (id, id_user, title, content) VALUES (null, :id_user, :title, :content)";
        $bdd = new Bdd();
        $statement = $bdd->pdo->prepare( $sql );
        $response = $statement->execute([
            "id_user" => $this->id_user,
            "title" => $this->title,
            "content"=> $this->content
        ]);

        $status = [
            "success" => true,
            "error" => ""
        ];

        if (!$response) {

            $status = [
                "success" => false,
                "error" => $statement->errorInfo()
            ];

        }


        return $status;


    }

}