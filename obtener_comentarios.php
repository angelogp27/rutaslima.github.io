<?php
$conn = new mysqli("localhost", "root", "", "mi_sitio_web");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$ruta_id = $_GET['ruta_id'];
$comentarios = [];

$result = $conn->query("SELECT comentario, fecha FROM comentarios WHERE ruta_id = $ruta_id ORDER BY fecha DESC");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $comentarios[] = $row;
    }
}

echo json_encode($comentarios);

$conn->close();
?>