<?php
session_start();
date_default_timezone_set('America/Bogota');
if (isset($_POST)) {
    require_once '../Clases/BD.class.php';
    $con = new BD("localhost", "test", "root", "PpY8lfp838Et3716");    
    $usuario = $_POST['usuario'];
    $pass = (int) $_POST['pass'];
    $resultado = $con->findAll2("SELECT * FROM usuarios WHERE correo = '" . $usuario . "' and secret = '" . $pass . "'");
    if (count($resultado) == 0) {
        echo "error";
    } else {
        $now = date('Y-m-d H:i:s');
        $limit = date('Y-m-d H:i:s', strtotime('+10 min'));
        $update = "UPDATE usuarios SET fecha_hora = '" . $now . "', limite = '" . $limit . "' WHERE documento = " . $resultado[0]['documento'] . "";
        if ($con->exec($update)) {
            $_SESSION['obj_user'] = $resultado;
        }
        echo "ok";
    }
}