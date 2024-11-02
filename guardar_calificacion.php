<?php
$conn = new mysqli("localhost", "root", "", "mi_sitio_web");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ruta_id = $_POST['ruta_id'];
    $calificacion = $_POST['calificacion'];

    // Inserta la calificación en la base de datos
    $stmt = $conn->prepare("INSERT INTO calificaciones (ruta_id, calificacion) VALUES (?, ?)");
    $stmt->bind_param("ii", $ruta_id, $calificacion);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>