<?php
include("conn_bd.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convierte a entero para mayor seguridad
    $query = $conn->prepare("SELECT * FROM empleado WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p class='error'>Empleado no encontrado.</p>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $apellido = htmlspecialchars(trim($_POST['apellido']));
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $cargo = htmlspecialchars(trim($_POST['cargo']));

    if (empty($nombre) || empty($apellido) || empty($telefono) || empty($cargo)) {
        echo "<p class='error'>Todos los campos son obligatorios.</p>";
    } else {
        $updateQuery = $conn->prepare("UPDATE empleado SET nombre=?, apellido=?, telefono=?, cargo=? WHERE id=?");
        $updateQuery->bind_param("ssssi", $nombre, $apellido, $telefono, $cargo, $id);

        if ($updateQuery->execute()) {
            echo "<p class='success'>Empleado actualizado correctamente.</p>";
            header("Refresh: 2; URL=index.php"); // Redirige después de 2 segundos
        } else {
            echo "<p class='error'>Error al actualizar: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Empleado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
        }
        .container {
            max-width: 500px;
            background: white;
            padding: 20px;
            margin: 40px auto;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2 {
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <header>
        <?php include("header.php"); ?>
    </header>

    <div class="container">
        <h2>Actualizar Empleado</h2>
        <br>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required>
            <label>Apellido:</label>
            <input type="text" name="apellido" value="<?php echo $row['apellido']; ?>" required>
            <label>Teléfono:</label>
            <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>" required>
            <label>Cargo:</label>
            <input type="text" name="cargo" value="<?php echo $row['cargo']; ?>" required>
            <button type="submit">Actualizar</button>
        </form>
    </div>

    <footer>
        <?php include("footer.php"); ?>
    </footer>

</body>
</html>
