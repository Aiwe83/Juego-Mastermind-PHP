<?php
spl_autoload_register(function ($clase) {
    require("./clases/$clase.php");
});

session_start();

$clave = Clave::obtener_clave();

if (isset($_POST['submit'])) {
    switch ($_POST['submit']) {
        case "Resetear la Clave":
            $clave::generar_clave();
            $clave::guardar_clave();
            $texto_informativo = "Se ha reseteado la clave";
            exit;
        case "Jugar":
            $jugada = new Jugada($_POST['combinacion']);
            $texto_informativo = $jugada->valida_jugada();
            break;
        case "Mostrar Clave":
            // Implementar mostrar clave
            break;
        case "Ocultar Clave":
            // Implementar ocultar clave
            break;
        default:
            // Si no se proporciona ninguna opción válida, redirigir
            header("Location:Update parametrizado.php");
            exit;
    }
}
