<?php
$conn = new mysqli("localhost", "root", "", "mi_sitio_web");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ruta_id = $_POST['ruta_id'];
    $comentario = $_POST['comentario'];

    // Inserta el comentario en la base de datos
    $stmt = $conn->prepare("INSERT INTO comentarios (ruta_id, comentario, fecha) VALUES (?, ?, NOW())");
    $stmt->bind_param("is", $ruta_id, $comentario);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>