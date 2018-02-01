<?php
session_start();
unset($_SESSION['obj_user']);
session_destroy();
header("location: ../index.php");

