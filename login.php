<?php
session_start();
include('conexao.php');

if(empty($_POST['email']) || empty($_POST['password'])) {
    header('Location: index.php');
    exit();
}

$email = mysqli_real_escape_string($conexao, $_POST['email']);
$password = mysqli_real_escape_string($conexao, $_POST['password']);

$query = "select id_user, nome from usuarios where email = '{$email}' and senha = md5('{$password}')";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);



if($row ==1){
    $_SESSION['email'] = $email;
    header('Location: cadastro.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php');
    exit();
}