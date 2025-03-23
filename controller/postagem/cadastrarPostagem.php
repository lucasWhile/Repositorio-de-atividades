<?php
include '../../model/postagem.php';

session_start();
$id_usuario=$_SESSION["id_usuario"];


$titulo=$_POST["titulo"];

$descricao=$_POST["descricao"];

$id_categoria=$_POST["categoria"];
$data=date('Y-m-d H:i:s'); 

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $pasta = "../../uploads/";
    $nomeOriginal = $_FILES['imagem']['name'];
    $tempPath = $_FILES['imagem']['tmp_name'];
  
    // Gerando um nome único para evitar conflito
    $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
    $novoNome = uniqid() . "." . $extensao;
  
    // Validação simples: só permite JPG, PNG ou JPEG
    $permitidos = ['jpg', 'jpeg', 'png', 'gif'];
  
    if (in_array(strtolower($extensao), $permitidos)) {
      if (move_uploaded_file($tempPath, $pasta . $novoNome)) {
        $imagemNome = $novoNome;
      } else {
        echo "Erro ao mover imagem!";
        exit;
      }
    } else {
      echo "Formato de imagem inválido!";
      exit;
    }
  }

  $postagem=new postagem($titulo, $descricao, $imagemNome, $id_usuario,$data,$id_categoria);
  
  $postagem->cadastrarPostagem();
?>