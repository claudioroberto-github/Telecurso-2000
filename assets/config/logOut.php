<?php 

    session_start();
    header('Location: /Telecurso-2000/login.php');
    unset($_SESSION['email']);
    unset($_SESSION['passwords']);

?>