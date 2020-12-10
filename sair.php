<?php
session_start();
 setcookie("login",'');

session_destroy();

?>

<script>window.location="index.php";</script>