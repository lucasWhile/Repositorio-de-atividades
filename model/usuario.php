<?php
 class usuario 
{
    private $nome;
    private $email;
    private $senha;
    private $nivel;

    public function __construct($nome, $email, $senha, $nivel){
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->nivel = $nivel;
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
        $conn = $this->conexaoBanco();
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, nivel) VALUES (:nome, :email, :senha, :nivel)");
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':nivel', $this->nivel);
        $stmt->execute();
    }

    public function login(){
        $conn = $this->conexaoBanco();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result > 0){
            session_start();
   
            $_SESSION['id_usuario'] = $result['id_usuario'];
            $_SESSION['nome'] = $result['nome'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['nivel'] = $result['nivel'];

            return true;

        }
        else{
           return false;
        }
    }
    
   




    
    

    
}


?>