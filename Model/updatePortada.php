<?php

require_once '../Clases/BD.class.php';
$con = new BD("localhost", "test", "root", "PpY8lfp838Et3716");
$usuario = $_POST['usuario'];
$foto = $_POST['foto'];
$sql = "update usuarios set foto = '".$foto."' where documento = '".$usuario."'";
if ($con->exec($sql)>0) {
   echo "Ok" ;
}