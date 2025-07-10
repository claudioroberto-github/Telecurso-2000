<?php
    session_start();

    if(isset($_POST['submit-login']) && !empty($_POST['email']) && !empty($_POST['passwords']) && !empty($_POST['user'])){

        include_once('config.php');
        $email = $_POST['email'];
        $password = $_POST['passwords'];
        $user = $_POST['user'];

        $sql = "SELECT * FROM usuarios WHERE email = '$email' and passwords = '$password' and user = '$user'";

        $result = $conexao -> query($sql);

        if(mysqli_num_rows($result) < 1){
            header('Location: /Telecurso-2000/login.php');
            unset($_SESSION['email']);
            unset($_SESSION['passwords']);
        }
        else{
            $_SESSION['email'] = $email;
            $_SESSION['passwords'] = $password;
            $_SESSION['user'] = $user;
            header('Location: /Telecurso-2000/home.php');
        }

    }
    else{
        header('Location: /Telecurso-2000/login.php');
    }

?>