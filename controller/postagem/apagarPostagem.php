<?php
include '../../model/postagem.php';

$id_postagem=$_GET['id_postagem'];

$postagem=new postagem('','', '', '','','');
$postagem->apagarPostagem($id_postagem);


header("Location:../../view/index.php");

?>