<?php
require 'flight/Flight.php';

Flight::route('/', function(){

    Flight::render( "home", [
        "title" => "HomePage"
    ] );

});

Flight::route('/inscription', function(){
    
    Flight::render( "inscription" );

});

Flight::route('POST /servicesubscribe', function(){

    $username = Flight::request()->data["username"];
    $password = Flight::request()->data["password"];

    $user = new User( $username, $password );
    $status = $user->create();



});

Flight::route('POST /servicelogin', function(){

    $username = Flight::request()->data["username"];
    $password = Flight::request()->data["password"];

    //Traitement
    

});

Flight::route('/login', function(){

    //Traitement
    
    //Affichage
    Flight::render("login");

});

Flight::start();