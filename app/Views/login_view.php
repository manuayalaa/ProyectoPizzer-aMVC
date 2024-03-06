<?php 
/**
 * @author Manuel David Ayala Reina
 */
session_start();

$usuario = 'Manuel David';
$contrasena = 'Ayala';
if (!isset($_POST['iniciarsesion'])){
    header('location:gestioncomandas');
}
if ($_POST['usuario'] == $usuario && $_POST['contrasena'] == $contrasena){
    $_SESSION['usuario'] = $usuario;
    $_SESSION['auth'] = true;
    header('location:gestioncomandas');


}
?>
