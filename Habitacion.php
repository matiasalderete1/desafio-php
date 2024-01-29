<?php

class Habitacion {
    public $numero;
    public $tipo;
    public $precioPorNoche;
    public $capacidad;
    public $descripcion;

    public function __construct($numero, $tipo, $precioPorNoche, $capacidad, $descripcion) {
        $this->numero = $numero;
        $this->tipo = $tipo;
        $this->precioPorNoche = $precioPorNoche;
        $this->capacidad = $capacidad;
        $this->descripcion = $descripcion;
    }
}

