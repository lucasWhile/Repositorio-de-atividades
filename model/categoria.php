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


    

}


?>