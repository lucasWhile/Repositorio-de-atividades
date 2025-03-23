<?php
include '../../model/categoria.php';

session_start();
$id_usuario=$_SESSION["id_usuario"];
$nome_categoria=$_POST['nome_categoria'];

$categoria=new categoria($nome_categoria,'',$id_usuario);

$categoria->cadastrar();

?>