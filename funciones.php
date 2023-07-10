<?php
spl_autoload_register(function ($clase) {
    require "clases/$clase.php";
});

session_start();

function obtener_jugadas()
{
    $texto = null;

    if (isset($_SESSION["jugadas"]) && !empty($_SESSION["jugadas"])) {
        $jugadas = array_reverse($_SESSION["jugadas"]);
        foreach ($jugadas as $pos => $jugada) {
            $p = sizeof($jugadas) - $pos;
            $texto .= "Jugada numero $p:$jugada<br/>";
        }
    }

    return $texto;
}

function valora_fin_juego(Jugada $jugada): void
{
    if ($jugada->getPosiciones() == 4) {
        $_SESSION["resultado"] = true;
        header("Location: fin.php");
        exit;
    }
}

function comprobar_fin_juego(): void
{
    if (isset($_SESSION["jugadas"]) && sizeof($_SESSION["jugadas"]) >= 15) {
        $_SESSION["resultado"] = false;
        header("Location: fin.php");
        exit;
    }
}