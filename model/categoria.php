<?php

class categoria 
{

    private $nome;
    private $data;
    private $id_usuario;

    public function __construct($nome, $data, $id_usuario) {
        $this->nome = $nome;
        $this->data = $data;
        $this->id_usuario = $id_usuario;
    }

    public function conexaoBanco(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=repositorio_trabalho", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "Connection failed: ". $e->getMessage();
        }
    }

    public function cadastrar(){
        $this->data = date('Y-m-d H:i:s'); 
        $conn = $this->conexaoBanco();
        $stmt = $conn->prepare("INSERT INTO categorias (nome, data, id_usuario) VALUES (:nome, :data, :id_usuario)");
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':data', $this->data);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->execute();
    }

    
    public function listarCategorias(){
        $conn = $this->conexaoBanco();
        $stmt = $conn->prepare("SELECT * FROM categorias");
      
        if ($stmt->execute()) {
            $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $categorias;
        } else {
            return []; // Retorna array vazio caso haja erro
        }
    }


       public function MudarCategoria($novaCategoria,$id){
        $conn = $this->conexaoBanco();

        $stmt = $conn->prepare("UPDATE categorias set nome=:novaCategoria where id_categoria=:id");

        $stmt->bindParam(':novaCategoria',$novaCategoria);
        $stmt->bindParam(':id',$id_categoria);
        $stmt->execute();
      
    }

    public function BuscarUnicaCategoria($id){
    $conn = $this->conexaoBanco();

    $stmt = $conn->prepare("SELECT * FROM categorias WHERE id_categoria = :id");

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
        return $categoria ? $categoria : null;
    } else {
        return null; // Retorna null em caso de erro
    }
    }


    public function atualizarCategoria($id, $nome){
    $conn = $this->conexaoBanco();

    $stmt = $conn->prepare("UPDATE categorias SET nome = :nome WHERE id_categoria = :id");

    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}







    

}


?>