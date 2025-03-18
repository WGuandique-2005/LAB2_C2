<?php include("conn_bd.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Diseño del contenedor */
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #333;
        }

        p {
            font-size: 16px;
            color: #555;
        }

        a.insertar {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            text-decoration: none;
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
            font-weight: bold;
        }

        a.insertar:hover {
            background-color: #218838;
        }

        /* Diseño de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Botones de acción */
        .btn {
            padding: 8px 12px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #000;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <header>
        <?php include("header.php"); ?>
    </header>

    <div class="container">
        <h2>Listado de empleados</h2>
        <p>¿Desea ingresar un empleado?</p>
        <a href="insert.php" class="insertar">Insertar Empleado</a>
        <hr>

        <?php 
        $li_empleados = $conn->query('SELECT * FROM empleado');
        if ($li_empleados->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Teléfono</th><th>Cargo</th><th>Acciones</th></tr>";
            while ($row = $li_empleados->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["apellido"] . "</td>";
                echo "<td>" . $row["telefono"] . "</td>";
                echo "<td>" . $row["cargo"] . "</td>";
                echo "<td>
                        <a href='update.php?id=" . $row["id"] . "' class='btn btn-edit'>Editar</a> 
                        <a href='delete.php?id=" . $row["id"] . "' class='btn btn-delete'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay empleados registrados.</p>";
        }
        ?>
    </div>

    <footer>
        <?php include("footer.php"); ?>
    </footer>
</body>

</html>
