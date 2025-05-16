<?php
session_start();
include '../../model/categoria.php';

    $id = $_POST['id_categoria'];
    $nome = $_POST['nome'];


        $categoria = new categoria('', '', '');

        if ($categoria->atualizarCategoria($id, $nome)) {
            $_SESSION['msg'] = "Categoria atualizada com sucesso!";       
            header("Location:../../view/editarCategoria.php?id=$id");// Ajuste para a página que lista as categorias
           
        }
     
?>
