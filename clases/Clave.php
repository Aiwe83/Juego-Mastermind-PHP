<?php

class Clave
{
    const COLORES = [
        "Azul",
        "Rojo",
        "Naranja",
        "Verde",
        "Violeta",
        "Rosa",
        "Amarillo"
    ];

    static private $clave;

    static public function obtener_clave()
    {
        if (!isset($_SESSION["clave"])) {
            $_SESSION["clave"] = self::generar_clave();
        }

        self::$clave = $_SESSION["clave"];
    }

    static private function generar_clave()
    {
        $posiciones = array_rand(self::COLORES, 4);
        $clave = [];

        foreach ($posiciones as $posicion) {
            $clave[] = self::COLORES[$posicion];
        }

        return $clave;
    }

    static public function ver_clave()
    {
        self::obtener_clave();

        $html = "";

        foreach (self::$clave as $color) {
            $html .= "<span style='$color'>$color</span> ";
        }

        return $html;
    }

    static function getClave()
    {
        if (isset(self::$clave)) {
            return self::$clave;
        }
    }
}