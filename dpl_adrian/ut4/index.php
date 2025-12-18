<?php
// Configuración conexión PostgreSQL (TravelRoad server)
$host = "localhost";          // Ej: "localhost" o IP
$port = "5432";                        // Puerto por defecto PostgreSQL
$dbname = "travelroad";     // Nombre de la base TravelRoad
$user = "travelroad_user";                  // Usuario PostgreSQL
$password = "dpl0000";           // Contraseña PostgreSQL

// Crear conexión con manejo de errores excepciones
$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);
if (!$conn) {
    die("Error: No se pudo conectar a TravelRoad PostgreSQL");
}

// Preparar consulta con pg_prepare y ejecutar con pg_execute
$queryName = "get_places";
$sql = "SELECT * FROM places";
$prepareResult = pg_prepare($conn, $queryName, $sql);
if (!$prepareResult) {
    die("Error al preparar la consulta.");
}

$result = pg_execute($conn, $queryName, []);
if (!$result) {
    die("Error en la ejecución de la consulta.");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>TravelRoad - Datos desde PostgreSQL</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        caption { font-size: 1.5em; margin-bottom: 10px; }
    </style>
</head>
<body>
    <table>
        <caption>Destinos TravelRoad</caption>
        <thead>
            <tr>
                <th>País</th>
                <th>Visitado</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = pg_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= $row['visited'] === 't' ? 'Sí' : 'No' ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php
pg_close($conn);
?>

