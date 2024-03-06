<?php

/**
 * @author Manuel David Ayala Reina
 */
session_start();
include '../app/Config/productos.php';

if (!isset($_SESSION["cesta"])) {
    $_SESSION["cesta"] = array();
}
$ultimosProductos = isset($_COOKIE["ultimosProductosCookie"]) ? json_decode($_COOKIE["ultimosProductosCookie"], true) : array();

if (isset($_POST["anadir"])) {
    foreach ($productos["postres"] as $clave => $postre) {
        if (isset($_POST["postre" . $clave])) {
            $cesta = array(
                "nombre" => $postre["nombre"],
                "cantidad" => $_POST["cantidad" . $clave],
                "precio" => $postre["precio"],
                "imagen" => $postre["imagen"]
            );
            array_push($_SESSION["cesta"], $cesta);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria Ayala Reina Manuel David</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1>faMia</h1>
    <a href="cierresesion">Cerrar sesión</a>
    <h2>Productos</h2>
    <nav>
        <ul id='navli'>
            <li><a href="pizzas">Pizzas</a></li>
            <li><a href="bebidas">Bebidas</a></li>
            <li><a href="postres">Postres</a></li>
            <li><a href="carrito">Carrito</a></li>
        </ul>
    </nav>
    <h2>Postres</h2>
    <main>
        <form action="" method="post">
            <div id='formpizzas'>
                <?php
                foreach ($productos['postres'] as $key => $value) {
                    echo "<div class='item'>";
                    echo "<img src='../img/" . $value['imagen'] . "' alt='" . $value['nombre'] . "'>";
                    echo "<h3>" . $value['nombre'] . "</h3>";
                    echo "<p>" . $value['precio'] . "€</p>";
                    echo "<input type='radio' name='postre" . $key . "' id='postre" . $key . "' value='seleccionar'>Seleccionar";
                    echo "<input type='number' name='cantidad" . $key . "' id='cantidad" . $key . "' min='1' max='10' value='1'>";
                    echo "</div>";
                }
                ?>
            </div>
            <input type="submit" value="Añadir al carrito" name="anadir">
        </form>
    </main>
    <footer>
        <h3>Productos Recomendados:</h3>
        <ul>
            <?php
            // Mostrar los productos recomendados
            if ($ultimosProductos) {
                foreach ($ultimosProductos as $productoInfo) {
                    $tamano = isset($productoInfo['tamano']) ? $productoInfo['tamano'] : 'Sin tamaño';
                    echo "<li>{$productoInfo['nombre']} ({$tamano}) - {$productoInfo['precio']}€</li>";
                    echo "<img src='../img/{$productoInfo['imagen']}' alt='{$productoInfo['nombre']}'>";
                }
            } else {
                echo "<li>No hay productos recomendados.</li>";
            }

            ?>

        </ul>
    </footer>
</body>

</html>