<?php
session_start();
require_once '../Clases/BD.class.php';
$con = new BD("localhost", "test", "root", "PpY8lfp838Et3716");
$valor = $_POST['valor'];
$campoEdit = $_POST['campoEdit'];
$sql = "update usuarios set ".$campoEdit." = '".$valor."' where documento = '".$_SESSION['obj_user'][0]['documento']."'";
if ($con->exec($sql)>0) {
   echo "Ok" ;
}