<?php

// Se requiere el archivo funciones.php que contiene las clases y funciones necesarias para el juego
require_once "funciones.php";

// comprobar si hemos terminado el juego
comprobar_fin_juego();

// Se obtiene la clave que se utilizará en el juego
$clave = Clave::obtener_clave();

// Se inicializan las variables que se utilizarán para mostrar la información en la página
$ver_ocultar_clave = "Ver clave";
$informacion = "";

// Si se ha enviado algún formulario mediante POST
if (isset($_POST["submit"])) {

    // Se obtiene el valor del botón que ha sido pulsado
    $opcion = $_POST["submit"];

    // Se realiza una acción dependiendo del botón pulsado
    switch ($opcion) {

        // Si se ha pulsado el botón "Ver clave"
        case "Ver clave":
            // Se cambia el texto del botón a "Ocultar Clave"
            $ver_ocultar_clave = "Ocultar Clave";
            // Se obtiene la clave generada y se muestra en pantalla
            $informacion = Clave::ver_clave();
            break;

        // Si se ha pulsado el botón "Resetear clave"
        case "Resetear clave":
            // Se destruye la sesión actual y se inicia una nueva
            session_destroy();
            session_start();
            // Se genera una nueva clave para el juego
            $clave = Clave::obtener_clave();
            break;

        // Si se ha pulsado el botón "Ocultar Clave"
        case "Ocultar Clave":
            // Se cambia el texto del botón a "Ver clave"
            $ver_ocultar_clave = "Ver clave";
            break;

        // Si se ha pulsado el botón "Jugar"
        case "Jugar":
            // Se crea una nueva instancia de la clase Jugada con la combinación introducida por el usuario
            $jugada = new Jugada($_POST["combinacion"]);
            // Se muestra la jugada actual y el historial de jugadas
            $informacion = "Jugada actual: $jugada<br/>" . obtener_jugadas();
            // Se guarda la jugada actual en la sesión para mantener el historial
            $_SESSION["jugadas"][] = $jugada;
            // Se comprueba si el juego ha terminado
            valora_fin_juego($jugada);
            break;

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Título de la página</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
<fieldset>
    <legend>Opciones</legend>
    <form action="index.php" method="post">
        <input type="submit" name="submit" value="<?= $ver_ocultar_clave ?>"/>
        <input type="submit" name="submit" value="Resetear clave"/>
    </form>
</fieldset>
<fieldset>
    <legend>Información</legend>
    <?= $informacion ?: "No hay información disponible." ?>
</fieldset>
<fieldset>
    <legend>Menú del juego</legend>
    <form action="index.php" method="post">
        <?= Plantilla::genera_menu_select() ?>
        <input type="submit" name="submit" value="Jugar"/>
    </form>
</fieldset>
</body>
</html>