<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>

<h2>Calculadora Dockerizada:</h2>

<form method="post">
    <label>Valor 1:
        <input type="number" name="valor1" step="any" required>
    </label>

    <label>Valor 2:
        <input type="number" name="valor2" step="any" required>
    </label>

    <label>Operación:
        <select name="operacion">
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>
        </select>
    </label>

    <img src="./calculadora.png" alt="calculadora.png">

    <br>
    <button type="submit">Calcular</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $v1 = floatval($_POST["valor1"]);
    $v2 = floatval($_POST["valor2"]);
    $op = $_POST["operacion"];
    $resultado = "";

    switch ($op) {
        case "suma":
            $resultado = $v1 + $v2;
            break;
        case "resta":
            $resultado = $v1 - $v2;
            break;
        case "multiplicacion":
            $resultado = $v1 * $v2;
            break;
        case "division":
            if ($v2 != 0) {
                $resultado = $v1 / $v2;
            } else {
                $resultado = "Error: división por cero";
            }
            break;
        default:
            $resultado = "Operación no válida";
            break;
    }

    echo "<div class='resultado'>Resultado: $resultado</div>";
}
?>

</body>
</html>

