<?php
// store_task.php

// Conexión a la base de datos (reemplaza con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tareas_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fechaEstimadaFinalizacion = $_POST['fechaEstimadaFinalizacion'];
$creadorTarea = $_POST['creadorTarea'];
$responsableTarea = $_POST['responsableTarea'];
$prioridad = $_POST['prioridad'];
$observaciones = $_POST['observaciones'];

// Consulta SQL para insertar la tarea en la base de datos
$sql = "INSERT INTO tareas (titulo, descripcion, fechaEstimadaFinalizacion, creadorTarea, responsableTarea, idPrioridad, observaciones) 
        VALUES ('$titulo', '$descripcion', '$fechaEstimadaFinalizacion', '$creadorTarea', '$responsableTarea', '$prioridad', '$observaciones')";

if ($conn->query($sql) === TRUE) {
    echo "Tarea creada exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
