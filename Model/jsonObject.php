<?php

require_once '../clases/BD.class.php';
$conexion = new BD("localhost", "test", "root", "PpY8lfp838Et3716");

$userOnline = $_GET['user'];
$timestamp = ($_GET['timestamp'] == 0) ? time() : strip_tags(trim($_GET['timestamp']));
$lastId = (isset($_GET['lastid']) && !empty($_GET['lastid'])) ? $_GET['lastid'] : 0;
$tiempoTranscurrido = 0;
$lastIdQuery = '';

$selectUser = "Select * from usuarios u "
        . "inner join dispositivos_usuario d on d.documento = u.documento "
        . "where d.imei = '" . $userOnline . "' limit 1";

$u = $conexion->findAll2($selectUser);

if (empty($timestamp)) {
    die(json_encode(array('status' => 'error')));
}

if (!empty($lastId)) {
    $lastIdQuery = " AND id_registro > " . $lastId;
}

//if ($_GET['timestamp'] == 0) {
//    $select = "Select * from gps where imei = '" . $userOnline . "' order by id_registro desc limit 1";
//} else {
$select = "Select * from gps where imei = '" . $userOnline . "'" . $lastIdQuery . " order by id_registro desc limit 1";
//}
//echo $select;

$rs = $conexion->findAll2($select);


//if ($rs[0]['id_registro'] == $lastId) {
//    die(json_encode(array('status' => 'vacio', 'lastid' => $lastId, 'timestamp' => time())));
//    exit;
//}
//echo "hola mundo";


if (count($rs) <= 0) {
    while (count($rs) <= 0) {
        if (count($rs) <= 0) {
            //durar 30 segundos verificando
            if ($tiempoTranscurrido >= 30) {
                die(json_encode(array('status' => 'vacio', 'lastid' => $lastId, 'timestamp' => time())));
                exit;
            }
            sleep(1);
            $query = "select * from gps where imei = '" . $userOnline . "' and time >= $timestamp" . $lastIdQuery . " order by id_registro desc";
            $rs = $conexion->findAll2($query);
            $tiempoTranscurrido += 1;
        }
    }
}

$nuevaUbicacion = array();

if (count($rs) >= 1) {
    foreach ($rs as $value) {
        $nuevaUbicacion[] = array(
            'id_registro' => $value['id_registro'],
            'imei' => $value['imei'],
            'latitud' => $value['latitud'],
            'longitud' => $value['longitud'],
            'fecha' => $value['fecha'],
            'time' => $value['time']
        ); //     
    }
}


$ultimoaUbicacion = end($nuevaUbicacion);
$ultimoId = $ultimoaUbicacion['id_registro'];


die(json_encode(array('status' => 'resultados', 'timestamp' => time(), 'lastid' => $ultimoId, 'datos' => $nuevaUbicacion, 'nombre' => $u[0]['nombre'])));
