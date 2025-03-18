<?php
include("conn_bd.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM empleado WHERE id = $id";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Empleado no encontrado.";
        exit();
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $cargo = $_POST['cargo'];

    $updateQuery = "UPDATE empleado SET nombre='$nombre', apellido='$apellido', telefono='$telefono', cargo='$cargo' WHERE id=$id";
    
    if ($conn->query($updateQuery) === TRUE) {
        echo "Empleado actualizado correctamente.";
        header("Location: index.php");
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Empleado</title>
    <style>
        form {
            width: 50%;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 5px;
        }

        button {
            padding: 10px;
            margin-top: 10px;

        }
    </style>
</head>
<body>
    <header>
        <?php include("header.php"); ?>
    </header>
    <br>
    <div class="container">
    <h2>Actualizar Empleado</h2>
    <br>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required><br>
        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?php echo $row['apellido']; ?>" required><br>
        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>" required><br>
        <label>Cargo:</label>
        <input type="text" name="cargo" value="<?php echo $row['cargo']; ?>" required><br>
        <button type="submit" name="update">Actualizar</button>
    </form>
    </div>
    <footer>
        <?php include("footer.php"); ?>
    </footer>
</body>
</html>
