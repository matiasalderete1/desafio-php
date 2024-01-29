<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center">Reservas Actuales</h1>

        <?php

        require_once 'Habitacion.php';
        require_once 'Reserva.php';
        require_once 'Funciones.php';

        $numeroHabitacion = '';
        $fechaCheckIn = '';
        $fechaCheckOut = '';
        $mensajeDisponibilidad = '';  // Inicializamos la variable
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numeroHabitacion = isset($_POST['habitacion']) ? $_POST['habitacion'] : '';
            $fechaCheckIn = isset($_POST['checkin']) ? $_POST['checkin'] : '';
            $fechaCheckOut = isset($_POST['checkout']) ? $_POST['checkout'] : '';

            if (!empty($numeroHabitacion) && !empty($fechaCheckIn) && !empty($fechaCheckOut)) {
                $habitacion = new Habitacion($numeroHabitacion, 'Tipo no especificado', 0, 0, 'Descripción no especificada');
                $reserva = new Reserva(0, $habitacion, $fechaCheckIn, $fechaCheckOut, 0, 'Pendiente');

                $reservasArray = obtenerReservas();

                if (validarReserva($reserva, $reservasArray)) {
                    $reservasArray[] = $reserva;
                    guardarReservas($reservasArray);
                    $mensajeDisponibilidad = 'Habitación disponible. Reserva realizada.';
                } else {
                    $mensajeDisponibilidad = 'Habitación no disponible. Ya hay una reserva para ese período.';
                }

                listarReservas($reservasArray);
            }
        }
        ?>

        <!-- Agregar espacio entre la tabla y el título "Nueva Reserva" -->
        <div style="margin-bottom: 20px;"></div>

        <h2 class="text-center">Nueva Reserva</h2>

        <?php
        // Verificamos si la variable $mensajeDisponibilidad está definida antes de mostrarla
        if (!empty($mensajeDisponibilidad)) {
            echo '<div class="alert alert-info" role="alert">' . $mensajeDisponibilidad . '</div>';
        }
        ?>

        <form method="post">
            <div class="form-group">
                <label for="habitacion">Número de Habitación:</label>
                <input type="text" name="habitacion" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="checkin">Fecha de Check-in:</label>
                <input type="date" name="checkin" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="checkout">Fecha de Check-out:</label>
                <input type="date" name="checkout" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Realizar Reserva</button>
        </form>
    </div>
</body>

</html>