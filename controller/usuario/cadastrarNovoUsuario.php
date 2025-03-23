<?php
include '../../model/usuario.php';

echo $nome=$_POST['nome'];
echo $email=$_POST['email'];
echo $senha=$_POST['senha'];
echo $nivel=$_POST['nivel'];


$usuario = new Usuario($nome, $email, $senha, $nivel);

$usuario->cadastrar();




 

?>