<?php

class postagem{
    private $titulo;
    private $descricao;
    private $imagem;
    private $id_usuario;
    private $data;
    private $id_categoria;

    public function __construct($titulo, $descricao, $imagem, $id_usuario,$data,$id_categoria){
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->id_usuario = $id_usuario;
        $this->data = $data;
        $this->id_categoria = $id_categoria;
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

    public function cadastrarPostagem(){

        $conn = $this->conexaoBanco();
        $stmt = $conn->prepare("INSERT INTO postagem (titulo, descricao, imagem,data, id_usuario,id_categoria) VALUES (:titulo, :descricao, :imagem, :data, :id_usuario, :id_categoria )");
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':imagem', $this->imagem);
        $stmt->bindParam(':data', $this->data);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->bindParam(':id_categoria',$this->id_categoria); 
        $stmt->execute();
    }
    

    public function listarPostagens(){
        $conn = $this->conexaoBanco();
        $stmt = $conn->prepare("SELECT * FROM postagem ORDER BY data DESC limit 10");
   

        if ($stmt->execute()) {
            $ultimasPostagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $ultimasPostagens;
        } else {
            return []; // Retorna array vazio caso haja erro
        }
    }

    public function buscarPostagemPorcategoria($id){
        $conn = $this->conexaoBanco();
        $stmt = $conn->prepare("SELECT * FROM postagem WHERE id_categoria = :id");
        $stmt->bindParam(':id', $id);

        
        if ($stmt->execute()) {
            $ultimasPostagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $ultimasPostagens;
        } else {
            return []; // Retorna array vazio caso haja erro
        }

}



public function apagarPostagem($id){
    $conn = $this->conexaoBanco();
    $stmt = $conn->prepare("DELETE FROM postagem WHERE id_postagem = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}


}

?>