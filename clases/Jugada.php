<?php

class Jugada
{
    private $colores_acertados;
    private $posiciones_acertadas;
    private $jugada;

    public function __construct(array $jugada)
    {
        $this->colores_acertados = 0;
        $this->posiciones_acertadas = 0;
        $this->jugada = $jugada;

        $this->jugar();
    }

    private function jugar()
    {
        $clave = Clave::getClave();
        $jugada = array_unique($this->jugada);

        foreach ($jugada as $pos => $color) {
            if (in_array($color, $clave)) {
                $this->colores_acertados++;
            }
        }

        foreach ($this->jugada as $pos => $color) {
            if ($color == $clave[$pos]) {
                $this->posiciones_acertadas++;
            }
        }
    }

    public function __toString(): string
    {
        $texto = "Posiciones: $this->posiciones_acertadas Colores: $this->colores_acertados => ";

        $clave = Clave::getClave();
        foreach ($this->jugada as $indice => $color) {
            $color_acertado = $clave[$indice] == $color;
            $clase = "";
            if ($color_acertado)
                $clase = "acertado";
            $texto .= "<span class='$color'><span class='$clase'>$color</span></span> ";
        }

        return $texto;
    }

    public function getPosiciones()
    {
        return $this->posiciones_acertadas;
    }
}
