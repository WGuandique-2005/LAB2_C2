<?php
// Conexión a la base de datos
$conn = mysqli_connect("localhost","root","","empleados");
if (mysqli_connect_errno()) {
    echo "Error al conectarse a MySQL: " . mysqli_connect_error();
    exit();
}
else{
    //echo "Conexión exitosa";
}
?>