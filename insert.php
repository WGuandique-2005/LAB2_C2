<?php include 'conn_bd.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Empleado</title>
    <style>
        /* Diseño del contenedor principal */
        .container {
            max-width: 450px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        a {
            display: inline-block;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            margin-bottom: 15px;
        }

        a:hover {
            color: #0056b3;
        }

        /* Diseño del formulario */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            align-self: flex-start;
            margin-left: 10%;
            color: #555;
        }

        input {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Botón de registrar */
        button {
            margin-top: 20px;
            padding: 12px;
            width: 85%;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #0056b3;
        }

        /* Estilos para mensajes de éxito y error */
        .error {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }

        .success {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }

        @media (max-width: 600px) {
            .container {
                width: 90%;
            }

            input {
                width: 90%;
            }

            button {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <header>
        <?php include("header.php"); ?>
    </header>
    
    <div class="container">
        <h1>Insertar Empleado</h1>
        <a href="index.php">⬅ Volver al inicio</a>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $telefono = trim($_POST['telefono']);
            $cargo = trim($_POST['cargo']);

            // Validación de campos vacíos
            if (empty($nombre) || empty($apellido) || empty($telefono) || empty($cargo)) {
                echo "<p class='error'>❌ Todos los campos son obligatorios.</p>";
            } else {
                // Sanitizar los datos para evitar inyección SQL y XSS
                $nombre = htmlspecialchars($nombre);
                $apellido = htmlspecialchars($apellido);
                $telefono = htmlspecialchars($telefono);
                $cargo = htmlspecialchars($cargo);

                // Insertar en la base de datos
                $insertar = $conn->prepare("INSERT INTO empleado (nombre, apellido, telefono, cargo) VALUES (?, ?, ?, ?)");
                $insertar->bind_param("ssss", $nombre, $apellido, $telefono, $cargo);

                if ($insertar->execute()) {
                    echo "<p class='success'>✅ Empleado registrado correctamente.</p>";
                    header("Refresh: 2; URL=index.php"); // Redirige después de 2 segundos
                } else {
                    echo "<p class='error'>❌ Error al insertar: " . $conn->error . "</p>";
                }

                // Cerrar la consulta y conexión
                $insertar->close();
                $conn->close();
            }
        }
        ?>

        <form action="insert.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" required>

            <label for="cargo">Cargo:</label>
            <input type="text" name="cargo" required>

            <button type="submit">Registrar</button>
        </form>
    </div>

    <footer>
        <?php include("footer.php"); ?>
    </footer>
</body>
</html>
