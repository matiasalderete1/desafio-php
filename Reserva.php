<?php

class Reserva {
    public $numeroReserva;
    public $habitacion;
    public $fechaCheckIn;
    public $fechaCheckOut;
    public $costoTotal;
    public $estado;

    public function __construct($numeroReserva, $habitacion, $fechaCheckIn, $fechaCheckOut, $costoTotal, $estado) {
        $this->numeroReserva = $numeroReserva;
        $this->habitacion = $habitacion;
        $this->fechaCheckIn = $fechaCheckIn;
        $this->fechaCheckOut = $fechaCheckOut;
        $this->costoTotal = $costoTotal;
        $this->estado = $estado;
    }
}

