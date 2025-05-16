<?php

session_start();
include '../../model/postagem.php';
include '../../model/categoria.php';

$id_postagem = $_POST['id_postagem'];
$id_categoria = $_POST['categoria'];
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];

// Verifica se uma nova imagem foi enviada
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $diretorio = '../../uploads/';
    $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $nomeImagem = uniqid() . '.' . $extensao;
    
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $nomeImagem)) {
        $imagem = $nomeImagem;
    } else {
        echo "Erro ao fazer upload da imagem.";
        exit;
    }
} else {
    // Se não enviou nova imagem, mantém a imagem atual enviada no campo oculto
    $imagem = $_POST['imagem_atual'];
}

$postagemEditada = new postagem($titulo, $descricao, $imagem, '', '', $id_categoria);

$postagemEditada->EditarPostagem($id_postagem);

$_SESSION['msg']='edição salva com sucesso';

header("Location:../../view/editarPostagem.php?id_postagem=$id_postagem");

    

?>