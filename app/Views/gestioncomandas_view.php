<?php
session_start();
if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = false;
}

if ($_SESSION['auth'] == false) {
    echo "<h1>Inicio Sesión</h1>";
    echo "<form action='login' method='post'>";
    echo "<label for='usuario'>Usuario:</label>";
    echo "<input type='text' name='usuario' id='usuario'><br><br>";
    echo "<label for='contrasena'>Contraseña:</label>";
    echo "<input type='password' name='contrasena' id='contrasena'><br><br>";
    echo "<input type='submit' value='Iniciar sesión' name='iniciarsesion'>";
    echo "</form>";
} else {
    echo '<h2>Comandas:</h2>';
    $comandaDir = 'comandas/';
    $comandasList = glob($comandaDir . '*_pendiente.txt');

    if (isset($_POST['elaborar'])) {
        if (isset($_POST['comandas'])) {
            foreach ($_POST['comandas'] as $selectedComanda) {
                $comandaOriginal = $comandaDir . $selectedComanda . '.txt';
                $comandaElaborada = $comandaDir . $selectedComanda . '_elaborada.txt';

                if (rename($comandaOriginal, $comandaElaborada)) {
                    echo "El archivo '$selectedComanda.txt' se ha cambiado a '$comandaElaborada'.<br>";
                } else {
                    echo "Hubo un error al intentar cambiar el nombre del archivo '$selectedComanda.txt'.<br>";
                }
            }
        } else {
            echo "No se seleccionaron comandas para elaborar.<br>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Comandas Ayala Reina Manuel David</title>
</head>

<body>
    <form action="" method="post">
        <?php
        if ($_SESSION['auth'] == true) {
            $comandasList = glob($comandaDir . '*_pendiente.txt');
            foreach ($comandasList as $comanda) {
                echo '<input type="checkbox" name="comandas[]" value="' . basename($comanda, '.txt') . '">';
                echo basename($comanda) . '<br><br>';
            }
            echo '<input type="submit" value="Elaborar comandas" name="elaborar">';
        }
        ?>
    </form>

    <a href="cierresesioncomandas">Cerrar Sesión</a>
</body>

</html>
