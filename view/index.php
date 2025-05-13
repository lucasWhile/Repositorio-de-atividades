<?php session_start(); 
include_once '../model/postagem.php';
$ultimosPost= new postagem('','','','','','','');
$ultimasPostagens=$ultimosPost->listarPostagens();

include '../model/categoria.php';

$categoria= new categoria('','','');

$categorias= $categoria->listarCategorias();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Social Network Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Nome</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="ms-auto d-flex">
          <?php 
            if(isset($_SESSION['id_usuario'])){  ?>
            <a href="../controller/usuario/sair.php" class="btn btn-outline-secondary mt-2 mt-lg-0">👤Sair</a>
            <?php } else{
                 ?>
            <a href="login.html" class="btn btn-outline-secondary mt-2 mt-lg-0">👤Logar</a>

            <?php
            }    
            ?>

            <?php 
            if(isset($_SESSION['id_usuario'])){  ?>
            <a href="adicionarPostagem.php" class="btn btn-outline-secondary mt-2 mt-lg-0">Postar Projeto</a>
            <a href="adicionarCategoria.php" class="btn btn-outline-secondary mt-2 mt-lg-0">Adicionar Categoria</a>



            <?php      }
            ?>
          </div>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
        <nav class="col-lg-2 bg-white border-end p-2">
          <div class="list-group list-group-flush vh-lg-100 d-none d-lg-block">
            <h6 class="text-center mt-3 mb-2">Categorias</h6>
            <a href="index.php" class="list-group-item list-group-item-action active" >Destaques</a>

            <?php foreach($categorias as $c):?>
                

              <a href="postagemCategoria.php?id_categoria=<?php echo $c['id_categoria']?>" class="list-group-item list-group-item-action"><?php echo $c['nome'];?></a>

              <?php endforeach;?>
              
           
          </div>

          <!-- Accordion para MOBILE -->
          <div class="accordion d-lg-none mt-3" id="accordionCategories">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingCategories">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategories">
                  Categorias
                </button>
              </h2>
              <div id="collapseCategories" class="accordion-collapse collapse">
                <div class="accordion-body p-0">
                <a href="index.php" class="list-group-item list-group-item-action active" >Destaques</a>
                    <?php 
                    // Pega o id_categoria atual da URL (se existir)
                    $categoriaAtiva = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : null; 

                    foreach($categorias as $c):
                        // Verifica se o id_categoria atual é igual ao clicado
                        $activeClass = ($c['id_categoria'] == $categoriaAtiva) ? 'fw-bold active' : ''; 
                    ?>
                    <a href="postagemCategoria.php?id_categoria=<?php echo $c['id_categoria']?>" 
                        class="list-group-item list-group-item-action <?php echo $activeClass; ?>">
                        <?php echo $c['nome'];?>
                    </a>
                    <?php endforeach;?>
                </div>
                </div>
            </div>
          </div>
        </nav>

        <!-- Main Content -->




 <main class="col-lg-10 p-3">
  <div class="row">

    <?php foreach($ultimasPostagens as $postagem): ?>
      <div class="col-12 col-sm-6"> <!-- Responsividade -->
        <div class="card h-100 p-2">
          <?php if (!empty($postagem['imagem'])): ?>
            <img src="../uploads/<?php echo $postagem['imagem']; ?>" class="card-img-top" alt="Imagem do post" style="height: 200px; object-fit: cover;">
          <?php endif; ?>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?php echo htmlspecialchars($postagem['titulo']); ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($postagem['descricao']); ?></p>
            <p class="card-text"><?php echo htmlspecialchars($postagem['data']); ?></p>

            <div class="mt-auto d-flex">
            <?php 
                if(isset($_SESSION['id_usuario']) && $_SESSION['nivel']==='instrutor'){ ?>
                  <a href="editarPostagem.php?id_postagem=<?php echo $postagem['id_postagem'] ?>" class="btn btn-outline-danger mt-2 mt-lg-0">Editar</a>
                  <a href="../controller/postagem/apagarPostagem.php?id_postagem=<?php echo $postagem['id_postagem'] ?>" class="btn btn-outline-danger mt-2 mt-lg-0">Apagar</a>
                <?php }  ?>
                
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>


  </div>
</main>


    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>


<style>
      body {
        background-color: #f8f9fa;
      }
      .card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s;
      }
      .card:hover {
        transform: translateY(-5px);
      }
      .card-img-top {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s;
      }
      .card-img-top:hover {
        transform: scale(1.05);
      }
      .card-title {
        color: #0d6efd;
      }
      .date-text {
        font-size: 0.9rem;
        color: gray;
      }
      .btn-action {
        margin-right: 8px;
      }
    </style>