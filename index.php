<?php
require 'flight/Flight.php';
require_once "class/User.php";
require_once "class/Bdd.php";
require_once "class/Note.php";

session_start();

Flight::route('/', function(){

    if (isset($_GET["message"])) {

        echo "<div>" . $_GET["message"] . "</div>";

    }
    Flight::render( "home", [
        "title" => "HomePage"
    ]);

});

Flight::route('/inscription', function(){
    
    $error = Flight::request()->query["error"];

    Flight::render( "inscription", ["error" => $error] );

});

Flight::route('POST /servicesubscribe', function(){

    $username = Flight::request()->data["username"];
    $password = Flight::request()->data["password"];

    $user = new User( $username, $password );
    $status = $user->create();

    if ($status["success"] ) {

        Flight::redirect("/?message=Inscription ok !");
    }
    else {

        Flight::redirect("/inscription?error=" . $status["error"][2]);
    }


});

Flight::route('POST /servicelogin', function(){

    $username = Flight::request()->data["name"];
    $password = Flight::request()->data["pass"];

    $user = new User( $username, $password);
    $status = $user->login();

    if ($status["success"] ) {

        Flight::redirect("/note?message=Connexion OK!");

    }

    else {

        Flight::redirect("/login?error=" . $status["error"][2]);

    }
    

});

Flight::route('POST /serviceremovenote', function(){

     //Traitement
     $id = Flight::request()->data["note_remove"];

     $note = new Note();
     $note->getNote($id);

     $status = $note->removeNote($id);
 
     if ($status["success"]) {
 
         Flight::redirect("/note?message=Note supprimée !");
 
     }
 
     else {
 
         Flight::redirect("/note?error=" . $status["error"][2]);
 
     }

});

Flight::route('POST /serviceeditnote', function(){

    //Traitement
    $id = Flight::request()->data["note_edit"];

    $note = new Note();
    $note= $note->getNote($id);

    $form = "<form method='post' action='editnote'>";
    $form .= "<label>Titre :</label>";
    $form .= "<input type='text' name='title_edit' value='".$note->getNoteTitle()."'>";
    $form .= "<label>Contenu :</label>";
    $form .= "<textarea name='content_edit' style='min-width:200px;max-width:200px;min-height:50px;'>".$note->getNoteContent()."</textarea>";
    $form .= "<input type='hidden' name='id_edit' value='".$note->getNoteId() ."'>";
    $form .="<input type='submit' value='Modifier'>";
    $form .="</form>";

    echo $form;

});

Flight::route('/editnote', function(){

    //Traitement
    $id = Flight::request()->data["id_edit"];
    $title = Flight::request()->data["title_edit"];
    $content = Flight::request()->data["content_edit"];

    $note = new Note();

    $status = $note->editNote($id, $title, $content);


    if ($status["success"]) {

        Flight::redirect("/note?message=Note modifiée !");

    }

    else {

        Flight::redirect("/note?error=" . $status["error"][2]);

    }

});

Flight::route('/login', function(){

    //Affichage
    Flight::render("login");

});

Flight::route('/note', function(){

    //Affichage
    Flight::render("note");


});

Flight::route('/deconnection', function(){

    //Affichage
    session_unset();
    Flight::redirect("/");

});


Flight::route('/servicecreatenote', function(){

    //Traitement
    $title = Flight::request()->data["title"];
    $content = Flight::request()->data["content"];
    $id_user = $_SESSION["user"]["id"];

    $note = new Note($id_user, $title, $content );

    $status = $note->addNote();

    if ($status["success"]) {

        Flight::redirect("/note?message=Note ajoutée !");

    }

    else {

        Flight::redirect("/note?error=" . $status["error"][2]);

    }

});


Flight::start();