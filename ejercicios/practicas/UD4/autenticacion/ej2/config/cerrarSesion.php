<?php
session_start();

session_unset();

session_destroy();

header("location:../ej2.php");
?>