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


public function BuscarUnicaPostagem($id) {
    $conn = $this->conexaoBanco();
    $stmt = $conn->prepare("SELECT * FROM postagem WHERE id_postagem = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $postagem = $stmt->fetch(PDO::FETCH_ASSOC);
        return $postagem ?: []; // Retorna array vazio se não encontrar
    } else {
        return []; // Retorna array vazio em caso de erro na execução
    }
}


public function EditarPostagem($id)  {

    $conn = $this->conexaoBanco();
    $stmt = $conn->prepare("UPDATE postagem SET titulo=:titulo, descricao=:descricao,imagem=:imagem WHERE id_postagem=:id_postagem");
    $stmt->bindParam(':titulo', $this->titulo);
    $stmt->bindParam(':descricao', $this->descricao);
    $stmt->bindParam(':imagem', $this->imagem);
    $stmt->bindParam(':id_postagem', $id);

    $stmt->execute();
  
}

public function ObterId_categoria($id_postagem)  {

$conn = $this->conexaoBanco();

// Preparar a consulta SQL com a correção da cláusula WHERE
$stmt = $conn->prepare("SELECT categorias.id_categoria AS id_categoria 
                        FROM categorias 
                        INNER JOIN postagem ON categorias.id_categoria = postagem.id_categoria 
                        WHERE postagem.id_postagem = :id");

// Vincular o parâmetro :id à variável $id_postagem
$stmt->bindParam(':id', $id_postagem, PDO::PARAM_INT);

// Executar a consulta
$stmt->execute();

// Obter o resultado
 $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
$id_categoria = $resultado[0]['id_categoria'];  

// Se você quiser retornar os resultados
return $id_categoria;

    
}




}

?>