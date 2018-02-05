<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Inscription :</h1>
    <ul>
        <li>
            <a href="./">Retour au menu</a>
        </li>
    
    </ul>
    
    <?php
        if (isset($_GET["error"])) {

            echo "<div>" . $_GET["error"] . "</div>";
        }
    ?>
    <form action="servicesubscribe" method="post">
        <input type="text" name="username" >
        <input type="password" name="password" >
        <input type="submit" value="Inscription">
    </form>

</body>
</html>