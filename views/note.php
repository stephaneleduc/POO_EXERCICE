<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php

        if (!isset($_SESSION) || empty($_SESSION)) {

            Flight::redirect("/login");
        }

        else {
            if (isset($_GET["error"])) {

                echo "<div>" . $_GET["error"] . "</div>";
            }
            if (isset($_GET["message"])) {

                echo "<div>" . $_GET["message"] . "</div>";
            }
    ?>

            <ul>
                <li>
                    <a href="deconnection">Déconnexion <?php echo "(" . $_SESSION["user"]["username"] . ")"?></a>
                </li>
            </ul>

            <h1> VOS NOTES </h1>

            <form method="post" action="servicecreatenote" style="display:flex;flex-direction:column;width:200px;">
            
                <label>Titre :</label>
                <input type="text" name="title">
                <label>Contenu :</label>
                <textarea name="content" style="min-width:200px;max-width:200px;min-height:50px;"></textarea>
                <input type="submit" value="Ajouter">
            </form>
            <br>
        
    <?php

            Note::getNotesByUser($_SESSION["user"]["id"]);

        }
    ?>



</body>
</html>