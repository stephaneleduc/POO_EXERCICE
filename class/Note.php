<?php 
class Note {

    private $id = 0;
    private $id_user = 0;
    private $title = "";
    private $content = "";
    private $date = "";

    function __construct( $param_id_user = 0 , $param_title = "", $param_content = "" ){
        $this->id_user = $param_id_user;
        $this->title = $param_title;
        $this->content = $param_content;
    }



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

    function removeNote($id) {

        $sql = "DELETE FROM notes WHERE id=:id";
        $bdd = new Bdd();
        $statement = $bdd->pdo->prepare( $sql );
        $response = $statement->execute([
            "id" => $id,
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

    function editNote($id, $title, $content) {

        $sql = "UPDATE notes set title=:title, content=:content, date=:newdate
                WHERE id=:id";
        $bdd = new Bdd();
        $statement = $bdd->pdo->prepare( $sql );
        $response = $statement->execute([
            "id" => $id,
            "title" => $title,
            "content" => $content,
            "newdate" => date("Y-m-d H:i:s")
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


    function getNoteId () {


        return $this->id;

    }

    function getNoteIdUser () {

        return $this->id_user;
        
    }

    function getNoteTitle () {

        return $this->title;
        
    }

    
    function getNoteContent () {

        return $this->content;
        
    }


    function getNote( $id ) {

        $sql = "SELECT * FROM notes WHERE id=:id";
        $bdd = new Bdd();
        $statement = $bdd->pdo->prepare( $sql );
        $response = $statement->execute([
            "id" => $id,
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $note = new Note($result["id_user"], $result["title"], $result["content"] );
        $note->date = $result["date"];
        $note->id = $result["id"];

        return $note;

    }



    static function getNotesByUser ($id) {

        $sql = "SELECT * FROM notes where id_user=:id_user";
        $bdd = new Bdd();
        $statement = $bdd->pdo->prepare( $sql );
        $statement->execute([

            "id_user" => $id
        ]);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        echo "<div style='display:flex;justify-content:flex-start;flex-wrap:wrap;'>";

        foreach ($results as $result) {

            $note = new Note($result["id_user"], $result["title"], $result["content"]);
            $note->date = $result["date"];
            $note->id = $result["id"];

            $test = "<div style='border:1px solid black;text-align:center;margin:5px;padding:10px;overflow:auto;'>";
            $test .= "<h4>" . $note->title . "</h4>";
            $test .= "<h5>" . $note->date . "</h5>";
            $test .= "<p>" . $note->content . "</p>";
            $test .= "<form action='serviceeditnote' method='post'>";
            $test .= "<input style='display:none;' type='text' name='note_edit' value='".$note->id ."'>";
            $test .= "<input type='submit' value='Modifier'></form>";
            $test .= "</form><br>";
            $test .= "<form action='serviceremovenote' method='post'>";
            $test .= "<input style='display:none;' type='text' name='note_remove' value='".$note->id ."'>";
            $test .= "<input type='submit' value='Supprimer'></form>";
            $test .= "</form>";
            $test .= "</div>";

            echo $test;

        }

        echo "</div>";

    }


}