<?php
include("conn_bd.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $deleteQuery = "DELETE FROM empleado WHERE id = $id";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "Empleado eliminado correctamente.";
        header("Location: index.php");
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
} else {
    echo "ID no especificado.";
}
?>
