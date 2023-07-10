<?php

class Plantilla
{
    static public function genera_menu_select()
    {
        $html = "";

        for ($i = 0; $i < 4; $i++) {
            $html .= "<select name='combinacion[]'>";

            foreach (Clave::COLORES as $color) {
                $html .= "<option class='$color' value='$color'>$color</option>";
            }

            $html .= "</select>";
        }

        return $html;
    }
}