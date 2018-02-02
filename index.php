<?php
require 'flight/Flight.php';

Flight::route('/', function(){

    Flight::render( "home", [
        "title" => "HomePage"
    ] );

});

Flight::route('POST /inscriptionservice', function(){

    Flight::request()->query['id']; // $_GET
    Flight::request()->data["username"]; // $_POST

    //Traitement
    

    //Redirect
    Flight::redirect("/login");

});

Flight::route('/login', function(){

    //Traitement
    
    //Affichage
    Flight::render("login");

});

Flight::start();