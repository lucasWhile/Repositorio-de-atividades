<?php
include '../../model/usuario.php';

$email=$_POST['email'];
$senha=$_POST['senha'];


echo $email;
echo $senha;

$usuario = new Usuario('', $email, $senha, '');

echo $usuario->login();

header("Location:../../view/index.php");
?>