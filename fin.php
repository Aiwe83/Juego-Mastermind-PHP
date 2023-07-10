<?php

require_once "funciones.php";

$carga = fn($clase) => require "clases/$clase.php";
spl_autoload_register($carga);

// Comprobamos si la variable $acierto está definida y no es nula
if (!isset($_SESSION["resultado"])) {
    header("Location:Update parametrizado.php");
    exit;
}

$acierto = $_SESSION["resultado"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resultado del juego</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <?php
        if ($acierto) {
            echo "<h1>Felicidades, has acertado la clave</h1>";
        } else {
            echo "<h1>No lo has conseguido</h1>";
        }
    ?>

    <fieldset>
        <legend>Detalles del juego</legend>
        <h1>Clave: <?= Clave::ver_clave(); ?></h1>
        <h1>Listado de jugadas realizadas</h1>
        <h2><?= obtener_jugadas(); ?></h2>
        <form action="reiniciar.php">
            <button type="submit">Volver a jugar</button>
        </form>
    </fieldset>



</body>
</html>