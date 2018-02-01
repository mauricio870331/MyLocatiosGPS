<?php

require_once '../clases/BD.class.php';
$conexion = new BD("localhost", "test", "root", "PpY8lfp838Et3716");
$userOnline = $_GET['user'];
$select = "Select * from gps where imei = '" . $userOnline . "' order by id_registro";
$selectUser = "Select * from usuarios u "
        . "inner join dispositivos_usuario d on d.documento = u.documento "
        . "where d.imei = '" . $userOnline . "' limit 1";
$u = $conexion->findAll2($selectUser);
$rs = $conexion->findAll2($select);
if (count($rs) > 0) {
    die(json_encode(array('status' => 'resultados', 'datos' => $rs, 'nombre' => $u[0]['nombre'])));
} else {
    die(json_encode(array('status' => 'vacio')));
}