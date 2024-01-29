<?php

function validarReserva($reserva, $reservasActuales)
{
    foreach ($reservasActuales as $reservaActual) {
        if ($reservaActual->habitacion->numero == $reserva->habitacion->numero) {
            if (
                ($reserva->fechaCheckIn !== null && $reserva->fechaCheckIn >= $reservaActual->fechaCheckIn && $reserva->fechaCheckIn < $reservaActual->fechaCheckOut) ||
                ($reserva->fechaCheckOut !== null && $reserva->fechaCheckOut > $reservaActual->fechaCheckIn && $reserva->fechaCheckOut <= $reservaActual->fechaCheckOut)
            ) {
                return false; // Habitación no disponible para ese período
            }
        }
    }
    return true; // Habitación disponible
}

function listarReservas()
{
    // Obtener reservas
    $reservas = obtenerReservas();

    // Ajuste en la función de comparación para manejar fechas nulas
    usort($reservas, function ($a, $b) {
        $fechaA = $a->fechaCheckIn !== null ? strtotime($a->fechaCheckIn) : 0;
        $fechaB = $b->fechaCheckIn !== null ? strtotime($b->fechaCheckIn) : 0;

        return $fechaA - $fechaB;
    });

    // Mostrar tabla de reservas
    echo '<table class="table">';
    echo '<thead><tr><th scope="col">Número de Habitación</th><th scope="col">Check-in</th><th scope="col">Check-out</th></tr></thead>';
    echo '<tbody>';

    foreach ($reservas as $reserva) {
        echo '<tr>';
        echo '<td>' . $reserva->habitacion->numero . '</td>';
        echo '<td>' . $reserva->fechaCheckIn . '</td>';
        echo '<td>' . $reserva->fechaCheckOut . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}

function obtenerReservas()
{
    $reservas = [];

    $archivo = 'reservas.txt';
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        if ($contenido !== false) {
            $reservas = unserialize($contenido);
        }
    }

    return $reservas;
}

function guardarReservas($reservas)
{
    $archivo = 'reservas.txt';
    $contenido = serialize($reservas);
    file_put_contents($archivo, $contenido);
}
