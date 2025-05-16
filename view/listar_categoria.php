<?php
session_start();
include '../model/categoria.php';
include '../model/postagem.php';

$categoria= new categoria('','','');
$categorias= $categoria->listarCategorias();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Post - Social Network</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background-color: #f8f9fa;
      }
      .form-card {
        max-width: 600px;
        margin: 60px auto;
        border: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      }
      .form-control:focus {
        border-color: #0d6efd;
        box-shadow: none;
      }
      #preview-img {
        max-width: 100%;
        max-height: 300px;
        margin-top: 10px;
        display: none;
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php">Social Network</a>
      </div>
    </nav>

    <main class="container my-4">

      <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
      <?php endif; ?>

      <section>
        <header class="d-flex justify-content-between align-items-center mb-3">
          <h2>Categorias</h2>
          <a href="adicionarCategoria.php" class="btn btn-primary">Adicionar Nova Categoria</a>
        </header>

        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Editar</th>
                <th scope="col">Apagar</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categorias as $categoria): ?>
                <tr>
                  <th scope="row"><?php echo htmlspecialchars($categoria['nome']); ?></th>
                  <td><a type="button" href="editarCategoria.php?id=<?php echo $categoria['id_categoria'] ?>"  class="btn btn-secondary">Editar</a></td>
                  
                  <td><button type="button" class="btn btn-danger">Apagar</button></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </section>

    </main>
  </body>
</html>
