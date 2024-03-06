<?php

/**
 * @author Manuel David Ayala Reina
 */
session_start();
include '../app/Config/productos.php';
if (!isset($_SESSION["cesta"])) {
    $_SESSION["cesta"] = array();
}
$cesta = $_SESSION["cesta"];
$total = 0;

if (isset($_POST['tramitar'])) {
    // Generar ticket de compra
    $ticketDir = 'tickets/';
    $ticketFileName = $ticketDir . 'ticket_' . date('YmdHis') . '.txt';
    $ticketContent = "Detalles de la compra:\n";
    
    foreach ($cesta as $key => $value) {
        $ticketContent .= "Nombre: " . $value["nombre"] . "\n";
        $ticketContent .= "Cantidad: " . $value["cantidad"] . "\n";
        $ticketContent .= "Tamaño: " . (isset($value["tamano"]) ? $value["tamano"] : '') . "\n";
        $ticketContent .= "Precio: " . ($value["precio"] * $value["cantidad"]) . "€\n\n";
        $total += $value["precio"] * $value["cantidad"];
    }

    $ticketContent .= "Total: " . $total . "€\n";

    if (!is_dir($ticketDir)) {
        mkdir($ticketDir, 0755, true);
    }

    file_put_contents($ticketFileName, $ticketContent);

    

    // Generar comanda
    $comandaDir = 'comandas/';
    $comandaFileName = $comandaDir . 'comanda_' . date('YmdHis') . '_pendiente.txt';
    $comandaContent = "Comanda pendiente:\n";
    
    foreach ($cesta as $key => $value) {
        if (isset($value['tamano'])){
            $comandaContent .= $value["nombre"] . "\n";
        }
        
    }

    if (!is_dir($comandaDir)) {
        mkdir($comandaDir, 0755, true);
    }

    file_put_contents($comandaFileName, $comandaContent);


    $ultimosProductos = array_slice($cesta, -3); 
    $cookieName = "ultimosProductos";
    
    foreach ($ultimosProductos as $producto) {
        $cookieValue = json_encode($producto);
        setcookie('ultimosProductosCookie', json_encode($ultimosProductos), time() + 3600, '/');
    }
    header('location:cierresesion');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria Ayala Reina Manuel David</title>

</head>

<body>
    <h1>faMia</h1>
    <a href="cierresesion">Cerrar sesión</a>
    <h2>Productos en cesta:</h2>
    <nav>
        <ul id='navli'>
            <li><a href="pizzas">Pizzas</a></li>
            <li><a href="bebidas">Bebidas</a></li>
            <li><a href="postres">Postres</a></li>
            <li><a href="carrito">Carrito</a></li>
        </ul>
    </nav>
    <main>
        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Tamaño</th>
                <th>Precio</th>
                <th>PrecioXcantidad</th>
            </tr>
            <?php
            
            foreach ($cesta as $key => $value) {
                echo "<tr>";
                echo "<td>" . $value["nombre"] . "</td>";
                echo "<td>" . $value["cantidad"] . "</td>";
                echo "<td>" . (isset($value["tamano"]) ? $value["tamano"] : '') . "</td>";
                echo "<td>" . ($value["precio"]) . "</td>";
                echo "<td>" . ($value["precio"] * $value["cantidad"]) . "</td>";
                echo "</tr>";
                $total += $value["precio"] * $value["cantidad"];
            }
            echo '</table>';
            echo '<h3>Total:  ' . $total . '€</h3>';
            ?>
    </main>
    <form action="" method="post">
        <input type="submit" value="Tramitar pedido" name="tramitar">
    </form>

</body>

</html>