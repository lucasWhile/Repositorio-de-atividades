<?php

include '../../model/postagem.php';
include '../../model/categoria.php';

    $id_postagem = $_POST['id_postagem'];
    $categoria = $_POST['categoria'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    // Obter a imagem (se houver)
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        // Definir o diretório onde a imagem será salva
        $diretorio = '../../uploads/';
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nomeImagem = uniqid() . '.' . $extensao;
        
        // Mover a imagem para o diretório
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $nomeImagem)) {
             $imagem = $nomeImagem;
        } else {
            // Caso a imagem não seja carregada corretamente
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    } else {
        // Caso não haja uma imagem nova, manter a imagem existente
        $imagem = $_FILES['imagem']['name'];// Ou você pode definir outro campo para manter a imagem antiga
    }

    
    $postagemEditada= new postagem($titulo, $descricao, $imagem, '','','');

    $postagemEditada->EditarPostagem($id_postagem);

    $id_categoria=$postagemEditada->ObterId_categoria($id_postagem);

    //$mudarCategoria= new categoria();

  







    

?>